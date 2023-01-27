<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoCategories;
use App\Models\Videos;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use Auth;

class VideosController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('videos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video_categories = VideoCategories::get();
        return view('videos.create',compact('video_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'video' => 'required|file|mimetypes:video/mp4,video/mpeg,video/x-matroska',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

         //upload the image
         $imgfileName = $request->image->getClientOriginalName();
         $imgfilePath = 'images/' . $imgfileName;
         $isImgFileUploaded = Storage::disk('public')->put($imgfilePath, file_get_contents($request->image));

        //upload the video
        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;
        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
 
        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        // File URL to access the image in frontend
        $imgurl = Storage::disk('public')->url($imgfilePath);

        if ($isFileUploaded) {
            $video = new Videos();
            $video->title = $request->title;
            $video->category_id = $request->category_id;
            $video->user_id = Auth::user()->id;
            $video->description = $request->description;
            $video->path = $url;
            $video->disk = 'videos';
            $video->image_path = $imgurl;
            $video->save();

            //let the cron jobs convert the videos to desired specs
            $this->dispatch(new ConvertVideoForDownloading($video));
            $this->dispatch(new ConvertVideoForStreaming($video));
 
            return back()
            ->with('success','Video has been successfully uploaded.');
        }
 
        return back()
            ->with('error','Unexpected error occured');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Videos::find($id);
        return view('videos.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Videos::find($id);
        
        //lets add view count
        $data->views = $data->views + 1;
        $data->save();

        return view('videos.show',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
}
