<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Venues;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{    
    /**
     * list
     *
     * @return void
     */
    public function list()
    {
        try{
            $venueList =    Venues::select('id','title')->get();
            $userList =    User::select('id','name')->get();
            return view('reviews.list', compact('venueList','userList'));
        } catch(Exception $e){
            
        }
    }    
    
    /**
     * add
     *
     * @return void
     */
    public function add()
    {
        try{
            $venueList =    Venues::select('id','title')->get();
            $userList =    User::select('id','name')->get();
            return view('reviews.add', compact('venueList','userList'));
        } catch(Exception $e){
            
        }
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        try {
            if ($id != '') {
                $venueList = Venues::select('id', 'title')->get();
                $userList = User::select('id', 'name')->get();
                $review = Reviews::where('id', base64_decode($id))
                    ->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, reviews.*'))
                    ->first();
                return view('reviews.add')->with(['id' => $id, 'reviewList' => $review, 'venueList' => $venueList, 'userList' => $userList]);
            } else {
                return redirect()->route('reviews.list')->with('error', 'Something went wrong!');
            }
        } catch (Exception $e) {
            return redirect()->route('reviews.list')->with('error', $e->getMessage());
        }
    }   
    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save(Request $request)
    {
        try{
            $data = $request->all();
            if(!empty($data)){
                $Reviews = Reviews::firstOrNew(['id'  =>  base64_decode(request('review_id'))]);
                $Reviews->venus_id    = request('review_venue_type');    
                $Reviews->user_id   = request('review_user_type');
                $Reviews->review   = request('review');                        
                $Reviews->rate    = request('review_rate');   
                $Reviews->save();
            }
            return redirect()->route('reviews.list')->with('success','Review has been saved successfully.');
        } catch(Exception $e){
            return redirect()->route('reviews.list')->with('error',$e->getMessage());
        }
    }
    
    /**
     * ajaxList
     *
     * @return void
     */
    public function ajaxList()
    {
        
        try {
            $reviews = Reviews::join('users', 'reviews.user_id', '=', 'users.id')
                ->join('venues', 'reviews.venus_id', '=', 'venues.id')
                ->select(
                    'reviews.*',
                    'users.name as user_name',
                    'venues.title as venue_title',
                    DB::raw('DATE_FORMAT(reviews.created_at, "%d-%b-%Y") as formatted_date')
                )
                ->orderByDesc('reviews.id')
                ->get();
            
            if ($reviews->isEmpty()) {
                return response()->json(['data' => [], 'success' => true]);
            }
            
            return response()->json(['data' => $reviews, 'success' => true]);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'success' => false]);
        }      
    }
}
