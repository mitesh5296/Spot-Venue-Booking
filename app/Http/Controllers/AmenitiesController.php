<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenities;
use Intervention\Image\Facades\Image;
use DB;
use File;

class AmenitiesController extends Controller
{
    public function list()
    {
        try{
            return view('amenities.list');
        } catch(Exeption $e){
            
        }
    }
    public function add()
    {
        try{
            return view('amenities.add');
        } catch(Exeption $e){
            
        }
    }
    public function edit($id)
    {
        try{
            if($id != ''){
                $amenity = Amenities::where('id', base64_decode($id))->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, title, image, id'))->first();
                return view('amenities.add')->with(['id' => $id, 'amenity' => $amenity]);
            } else {
                return redirect()->route('amenities.list')->with('error','Something went to wrong!');
            }
        } catch(Exeption $e){
            return redirect()->route('amenities.list')->with('error',$e->getMessage());
        }
    }
    public function save(Request $request)
    {
        try{
            $data = $request->all();
            if(!empty($data)){
                if(isset($request->amenity_image)){
                    if(isset($request->amenity_image_value)){
                        $image_path = public_path('assets/images/amenities/'.$request->amenity_image_value);
                        if(File::exists($image_path)) {
                            File::delete($image_path);
                        }   
                    }
                    $image = $request->file('amenity_image');
                    $ext = '.'.$request->amenity_image->getClientOriginalExtension();
                    $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->amenity_image->getClientOriginalName());
                    $fileName =  str_replace(' ', '_', $fileName);
                    $location = public_path('assets/images/amenities/' . $fileName);
                    Image::make($image)->save($location);
                } else {
                    $fileName = request('amenity_image_value');
                }
                if(request('amenity_id') == ''){
                    if (Amenities::where('title', '=', request('amenity_title'))->exists()) {
                        return redirect()->route('amenities.list')->with('error','This amenity is already exist.');    
                    }
                } 
                $Amenities = Amenities::firstOrNew(['id' =>  base64_decode(request('amenity_id'))]);
                $Amenities->title = request('amenity_title');
                $Amenities->image = $fileName;
                $Amenities->save();
            }
            return redirect()->route('amenities.list')->with('success','Amenity has been saved successfully.');
        } catch(Exeption $e){
            return redirect()->route('amenities.list')->with('error',$e->getMessage());
        }
    }
    public function ajaxList()
    {
        try{
            $amenities = Amenities::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, title, image, id'))->get();
            return response()->json(['data' =>  $amenities, 'success' => true]);
        } catch(Exeption $e){
            return response()->json(['data' =>  [], 'success' => false]);
        }
    }
}
