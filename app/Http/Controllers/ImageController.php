<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\Album\StoreAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Album $album)
    {

        if( $request->hasFile("file") ){

            // Create img name
            $img_extention = $request -> file -> getClientOriginalExtension();
            $img_name = rand(1000000,10000000) . "." . $img_extention;   // name => 32632.png

            // Path
            $path = "images" ;

            // Upload
            $request -> file -> move( $path , $img_name );

            // Add images names in request array
            $requestData = [];
            $requestData += [ 'name' => $img_name ];
            $requestData += [ 'album_id' => $album->id ];

            // return response()->json([
            //     'requestData' => $requestData,
            // ]);

            // Store in DB
            try {
                $image = Image::create( $requestData );
                if(!$image){
                    return redirect() -> back()-> with( [ "failed" => "Error at store opration"] ) ;
                }
                return response()->json([
                    'status' => 'success'
                ]);
            } catch (\Exception $e) {
                return redirect() -> back()-> with( [ "failed" => "Error at store opration"] ) ;
            }


        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        $image = Image::where('id',$image->id)->with('album')->first();
        return view("images.show" , compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {


    }
}
