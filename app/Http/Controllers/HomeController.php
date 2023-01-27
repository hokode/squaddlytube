<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;

class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('videos');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }




    /**
     * lets have a function that will get all videos with limit and returns data in a json for the data columns
     */
    public function allVideos(Request $request)
    {


        $columns = array( 
            0 =>'id', 
            1 =>'user_id',
            2 =>'category_id',
            3 =>'title',
            4 =>'views',
            5 =>'disk',
            6 =>'path',
            7 =>'image_path',
            8 =>'converted_for_downloading_at',
            9 =>'converted_for_streaming_at',
            10 =>'created_at',
            11 =>'updated_at',
            12 =>'video_status',
            13 =>'description',
        );

        $totalData = Videos::count();
            
        $totalFiltered = $totalData;
        
        $colsData="";
        $limit = 25;
        $order = "id";
        $dir = "ASC";
        $start = 0;
    

        $allvideos = Videos::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

             if(empty($request->input('search.value')))
                    {       
                   
                        $allvideos = Videos::offset($start)
                                            ->limit($limit)
                                            ->orderBy($order,$dir)
                                            ->get();
                          
                    }
                    else {
                        $search = $request->input('search.value'); 
                
                        $allvideos =  Videos::where('id','LIKE',"%{$search}%")
                                                ->orWhere('title', 'LIKE',"%{$search}%")
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();
                
                        $totalFiltered = allvideos::where('id','LIKE',"%{$search}%")
                                                ->orWhere('title', 'LIKE',"%{$search}%")
                                                ->count();
                }
                            

        

            if(!empty($allvideos))
            {
                $colsData = $colsData."<div class='row mb-4'><h2 class='col-6 tm-text-primary'>Latest Videos</h2>
                           <div class='col-6 d-flex justify-content-end align-items-center'><form action='' class='tm-text-primary'>
                           Page <input type='text' value='1' size='1' class='tm-input-paging tm-text-primary'> of '$totalData' </form>
                           </div></div><div class='row tm-mb-90 tm-gallery'>";

                    foreach ($allvideos as $allvideo)
                    {

                        $edit =  $allvideo->id;
                        $delete =  $allvideo->id;
                        $uploaddate = date('j M Y h:i a',strtotime($allvideo->created_at));
                        $url = "videos/".$edit."/edit";
                    
                    
                        $colsData = $colsData."<div class='col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5'>
                                   <figure class='effect-ming tm-video-item'><img src='".$allvideo->image_path."' alt='Image' class='img-fluid'>
                                   <figcaption class='d-flex align-items-center justify-content-center'><h2>".$allvideo->title."</h2><a href='".$url."'>View more</a></figcaption>
                                   </figure><div class='d-flex justify-content-between tm-text-gray'><span>".$uploaddate."</span><span>".$allvideo->views." views</span></div></div>";
                    }
                
                $colsData = $colsData."</div><div class='row tm-mb-90'>
                <div class='col-12 d-flex justify-content-between align-items-center tm-paging-col'><a href='javascript:void(0);' class='btn btn-primary tm-btn-prev mb-2 disabled'>
                            Previous</a><div class='tm-paging d-flex'><a href='javascript:void(0);' class='active tm-paging-link'>1</a>
                            <a href='javascript:void(0);' class='tm-paging-link'>2</a><a href='javascript:void(0);' class='tm-paging-link'>3</a>
                            <a href='javascript:void(0);' class='tm-paging-link'>4</a></div><a href='javascript:void(0);' class='btn btn-primary tm-btn-next'>Next Page</a>
                            </div></div>";       
            }
            
            //check if colsData is empty
            if(empty($colsData)){
                $colsData = "<div class='col-xl-3 col-md-6'><div class='card plan-box'><div class='card-body p-4'><div class='d-flex'><div class='flex-grow-1'>No videos available</div></div></div></div></div>"; 
            }

          
        return response()->json(["data"=>$colsData, "recordsTotal"    => intval($totalData), "recordsFiltered" => intval($totalFiltered)]);
    }
}
