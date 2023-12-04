<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venues;
use App\Models\Categories;
use App\Models\Amenities;
use App\Models\VenueImages;
use Intervention\Image\Facades\Image;
use DB;
use Illuminate\Support\Facades\File;

class VenuesController extends Controller
{
    public function list()
    {
        try{
            return view('venues.list');
        } catch(Exeption $e){
            
        }
    }
    public function add()
    {
        try{
            $aminities = Amenities::select('id', 'title')->get();
            $categories = Categories::select('id', 'title')->get();
            return view('venues.add')->with(['categories' => $categories, 'aminities' => $aminities]);
        } catch(Exeption $e){
            
        }
    }
    public function edit($id)
    {
        try{
            if($id != ''){
                $venue = Venues::where('id', base64_decode($id))->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, venues.*'))->first();
                $aminities = Amenities::select('id', 'title')->get();
                $categories = Categories::select('id', 'title')->get();
                $venusImages = VenueImages::where('venue_id', base64_decode($id))->get();
                return view('venues.add')->with(['id' => $id, 'venue' => $venue, 'categories' => $categories, 'aminities' => $aminities, 'venusImages' => $venusImages]);
            } else {
                return redirect()->route('venues.list')->with('error','Something went to wrong!');
            }
        } catch(Exeption $e){
            return redirect()->route('venues.list')->with('error',$e->getMessage());
        }
    }
    public function save(Request $request)
    {
        try{
            $data = $request->all();
            if(!empty($data)){
                if(request('venue_id') == ''){
                    if (Venues::where('title', '=', request('venue_title'))->exists()) {
                        return redirect()->route('venues.list')->with('error','This venue is already exist.');    
                    }
                } 
                $Venues = Venues::firstOrNew(['id' =>  base64_decode(request('venue_id'))]);
                $Venues->title = request('venue_title');
                $Venues->categories = implode(",",request('venue_categories'));
                $Venues->amenities = implode(",",request('venue_aminities'));
                $Venues->location = request('venue_title');
                $Venues->state = request('venue_state');
                $Venues->city = request('venue_city');
                $Venues->start_time = request('venue_start_time');
                $Venues->end_time = request('venue_end_time');
                $Venues->charge_per_slot = request('venue_charge_per_slot');
                $Venues->available_days = request('venue_available_days');
                $Venues->exclude_dates = request('venue_exclude_date');
                $Venues->overwrite_default = request('venue_overwrite_start_time').'-'.request('venue_overwrite_end_time').'-'.request('venue_overwrite_amount');
                $Venues->save();
                $venueId = $Venues->id;
                if($venueId != ''){
                    if(isset($request->venue_images)){
                        $files = [];
                        if ($request->file('venue_images')){
                            foreach($request->file('venue_images') as $key => $file)
                            {
                                $file_name = time().rand(1,99).'.'.$file->extension();  
                                $fileName =  str_replace(' ', '_', $file_name);
                                $file->move(public_path('assets/images/venues/'), $fileName);
                                $files[]['name'] = $fileName;
                            }
                        }
                        foreach ($files as $key => $file) {
                            $VenueImages = new VenueImages();
                            $VenueImages->venue_id = $venueId;
                            $VenueImages->image = $file['name'];
                            $VenueImages->save();
                        }
                    } 
                }
            }
            return redirect()->route('venues.list')->with('success','Venue has been saved successfully.');
        } catch(Exeption $e){
            return redirect()->route('venues.list')->with('error',$e->getMessage());
        }
    }
    public function ajaxList()
    {
        try{
            $venues = Venues::select(DB::raw('DATE_FORMAT(venues.created_at, "%d-%b-%Y") as formatted_date, venues.*'))->get();
            return response()->json(['data' =>  $venues, 'success' => true]);
        } catch(Exeption $e){
            return response()->json(['data' =>  [], 'success' => false]);
        }
    }
}
