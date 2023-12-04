<?php

namespace App\Http\Controllers;
use DB;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{    
    /**
     * list
     *
     * @return void
     */
    public function list()
    {
        try{
            return view('users.list');
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
            return view('users.add');
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
        try{
            if($id != ''){
                $user = User::where('id', base64_decode($id))->select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, users.*'))->first();
                return view('users.add')->with(['id' => $id, 'user' => $user]);
            } else {
                return redirect()->route('users.list')->with('error','Something went to wrong!');
            }
        } catch(Exception $e){
            return redirect()->route('users.list')->with('error',$e->getMessage());
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
                if(request('user_id') == ''){
                    if (User::where('email', '=', request('user_email'))->exists()) {
                        return redirect()->route('users.list')->with('error','This email is already exist.');    
                    }
                } 
                $Users = User::firstOrNew(['id'  =>  base64_decode(request('user_id'))]);
                $Users->name    = request('user_name');    
                $Users->email   = request('user_email');
                $Users->phone   = request('user_phone');                        
                $Users->type    = request('user_type');   
                $Users->password= Hash::make(request('user_password'));
                $Users->save();
            }
            return redirect()->route('users.list')->with('success','User has been saved successfully.');
        } catch(Exception $e){
            return redirect()->route('users.list')->with('error',$e->getMessage());
        }
    }
    
    /**
     * ajaxList
     *
     * @return void
     */
    public function ajaxList()
    {
        try{
            $users = User::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_date, users.*'))
            ->orderByDesc('users.id')
            ->get();
            return response()->json(['data' =>  $users, 'success' => true]);
        } catch(Exception $e){
            return response()->json(['data' =>  [], 'success' => false]);
        }
    }
}
