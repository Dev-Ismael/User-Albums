<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use App\Http\Requests\Image\UpdateImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Image\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Album $album)
    {

        if( $request->hasFile("file") ){

            // Create img name
            $img_extention = $request -> file -> getClientOriginalExtension();
            $img_name = rand(1000000,10000000) . "." . $img_extention;   // name => 32632.png

            // Upload
            $request -> file -> storeAs("public/images/" , $img_name );

            // Add images names in request array
            $requestData = [];
            $requestData += [ 'name' => $img_name ];
            $requestData += [ 'album_id' => $album->id ];
            $requestData += [ 'user_id' => Auth::id() ];


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
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        $albums = Album::where('user_id', Auth::id() )->get();
        $image = Image::where('id',$image->id)->with('album')->first();
        return view("images.show" , compact('image', 'albums'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        // find id in Db With Error 404
        $image = Image::where([ ['id' , $image->id] , ['user_id', Auth::id()] ])->with('album')->first();
        if(!$image){
            return abort(404);
        }

        // save all request in one variable
        $requestData = $request->all();

        // Store in DB
        try {
            $update = $image-> update( $requestData );
                return redirect() -> back() -> with( [ "success" => "image moved to ". $image->album->name ] ) ;
            if(!$update)
                return redirect() -> back()-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> back()-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        // find id in Db With Error 404
        $image = Image::where([ ['id' , $image->id] , ['user_id', Auth::id()] ])->first();
        if(!$image){
            return abort(404);
        }

        // Delete Record from DB
        try {
            Storage::delete('public/images/'. $image->name );
            $delete = $image->delete();
                return redirect() -> back()-> with( [ "success" => "Image deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> back()-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> back()-> with( [ "failed" => "Error at delete opration"] ) ;
        }
    }
}
