<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Venues;
use App\Models\Reviews;
use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingController extends Controller
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
            return view('bookings.list', compact('venueList'));
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
            return view('bookings.add', compact('venueList'));
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
                $bookings = Bookings::where('id', base64_decode($id))
                    ->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, bookings.*'))
                    ->first();
                return view('bookings.add')->with(['id' => $id, 'bookingList' => $bookings, 'venueList' => $venueList]);
            } else {
                return redirect()->route('bookings.list')->with('error', 'Something went wrong!');
            }
        } catch (Exception $e) {
            return redirect()->route('bookings.list')->with('error', $e->getMessage());
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
                $Bookings = Bookings::firstOrNew(['id'  =>  base64_decode(request('booking_id'))]);
                $Bookings->venus_id    = request('booking_venue_type');    
                $Bookings->booking_date   = request('booking_date');
                $Bookings->slots   = request('booking_slot');                        
                $Bookings->amount    = request('booking_amount');   
                $Bookings->save();
            }
            return redirect()->route('bookings.list')->with('success','Booking has been saved successfully.');
        } catch(Exception $e){
            return redirect()->route('bookings.list')->with('error',$e->getMessage());
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
            $bookings = Bookings::join('venues', 'bookings.venus_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.title as venue_title',
                DB::raw('DATE_FORMAT(bookings.created_at, "%d-%b-%Y") as formatted_date'),
                DB::raw('DATE_FORMAT(bookings.booking_date, "%d-%b-%Y") as formatted_booking_date')
            )
            ->orderByDesc('bookings.id')
            ->get();
            if ($bookings->isEmpty()) {
                return response()->json(['data' => [], 'success' => true]);
            }            
            return response()->json(['data' => $bookings, 'success' => true]);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'success' => false]);
        }      
    }
}
