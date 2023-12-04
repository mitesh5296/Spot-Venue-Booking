<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Response;
use DB;
use Intervention\Image\Facades\Image;
use File;
  
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome()
    {
        return view('managerHome');
    }

    public function delete($id, $module)
    {
        try{
            if($id != '' && $module != ''){
                if($module == 'venues'){
                    $venueImagesObj = DB::table('venue_images')->where('venue_id', base64_decode($id));
                    $venueImages = $venueImagesObj->select('image')->get();
                    $deleted = $venueImagesObj->delete();
                    if($deleted > 0){
                        if(!empty($venueImages)){
                            foreach($venueImages as $imageObj){
                                $image_path = public_path('assets/images/'.$module.'/'.$imageObj->image);
                                if(File::exists($image_path)) {
                                    File::delete($image_path);
                                } 
                            }
                        }
                        DB::table($module)->where('id', base64_decode($id))->delete();
                    }
                } else {
                    $ModuleData = DB::table($module)->where('id', base64_decode($id));
                    $dataArray = $ModuleData->first();
                    $imageName = '';
                    if(!empty($dataArray)){
                        if(isset($dataArray->image)){
                            $imageName = $dataArray->image;
                        }
                    }
                    $deleted = DB::table($module)->where('id', base64_decode($id))->delete();
                    if($deleted == 1 && $imageName != ''){
                        $image_path = public_path('assets/images/'.$module.'/'.$imageName);
                        if(File::exists($image_path)) {
                            File::delete($image_path);
                        } 
                    }
                }
                return Response::json(['success' => true, 'message' => 'Record has been deleted!']);
            } else {
                return Response::json(['success' => false, 'message' => 'Something went to wrong!']);
            }
        } catch(Exeption $e){
            return Response::json(['success' => false, 'message' => 'Something went to wrong!']);
        }
    }
}