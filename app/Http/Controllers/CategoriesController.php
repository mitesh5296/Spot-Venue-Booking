<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Intervention\Image\Facades\Image;
use DB;
use File;

class CategoriesController extends Controller
{
    public function list()
    {
        try{
            return view('categories.list');
        } catch(Exeption $e){
            
        }
    }
    public function add()
    {
        try{
            return view('categories.add');
        } catch(Exeption $e){
            
        }
    }
    public function edit($id)
    {
        try{
            if($id != ''){
                $category = Categories::where('id', base64_decode($id))->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, title, image, time_range, id'))->first();
                return view('categories.add')->with(['id' => $id, 'category' => $category]);
            } else {
                return redirect()->route('categories.list')->with('error','Something went to wrong!');
            }
        } catch(Exeption $e){
            return redirect()->route('categories.list')->with('error',$e->getMessage());
        }
    }
    public function save(Request $request)
    {
        try{
            $data = $request->all();
            if(!empty($data)){
                if(isset($request->category_image)){
                    if(isset($request->category_image_value)){
                        $image_path = public_path('assets/images/categories/'.$request->category_image_value);
                        if(File::exists($image_path)) {
                            File::delete($image_path);
                        }   
                    }
                    $image = $request->file('category_image');
                    $ext = '.'.$request->category_image->getClientOriginalExtension();
                    $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->category_image->getClientOriginalName());
                    $fileName =  str_replace(' ', '_', $fileName);
                    $location = public_path('assets/images/categories/' . $fileName);
                    Image::make($image)->save($location);
                } else {
                    $fileName = request('category_image_value');
                }
                if(request('category_id') == ''){
                    if (Categories::where('title', '=', request('category_title'))->exists()) {
                        return redirect()->route('categories.list')->with('error','This category is already exist.');    
                    }
                } 
                $Categories = Categories::firstOrNew(['id' =>  base64_decode(request('category_id'))]);
                $Categories->title = request('category_title');
                $Categories->image = $fileName;
                $Categories->time_range = request('category_time_range');
                $Categories->save();
            }
            return redirect()->route('categories.list')->with('success','Category has been saved successfully.');
        } catch(Exeption $e){
            return redirect()->route('categories.list')->with('error',$e->getMessage());
        }
    }
    public function ajaxList()
    {
        try{
            $categories = Categories::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, title, image, time_range, id'))->get();
            return response()->json(['data' =>  $categories, 'success' => true]);
        } catch(Exeption $e){
            return response()->json(['data' =>  [], 'success' => false]);
        }
    }
}
