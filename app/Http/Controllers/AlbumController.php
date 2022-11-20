<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\Album\StoreAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("albums.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        // save all request in one variable
        $requestData = $request->all();
        $requestData += [ 'user_id' => Auth::id() ];

        // Store in DB
        try {
            $album = Album::create( $requestData );
                return redirect() -> route('album.show' , $album->id ) -> with( [ "success" => " Album store successfully"] ) ;
            if(!$album)
                return redirect() -> route('home')-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route('home')-> with( [ "failed" => "Error at store opration"] ) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        // find id in Db With Error 404
        $album = Album::findOrFail($album->id);
        $album = Album::where('id',$album->id)->with('images')->first();
        return view("albums.show" , compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        // find id in Db With Error 404
        $album = Album::where([ ['id' , $album->id] , ['user_id', Auth::id()] ])->first();
        if(!$album){
            return abort(404);
        }
        return view("albums.edit", compact("album"));
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
        // find id in Db With Error 404
        $album = Album::where([ ['id' , $album->id] , ['user_id', Auth::id()] ])->first();
        if(!$album){
            return abort(404);
        }

        // save all request in one variable
        $requestData = $request->all();

        // Store in DB
        try {
            $update = $album-> update( $requestData );
                return redirect() -> route('home') -> with( [ "success" => " Album update successfully"] ) ;
            if(!$update)
                return redirect() -> route('home')-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route('home')-> with( [ "failed" => "Error at store opration"] ) ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        // find id in Db With Error 404
        $album = Album::where([ ['id' , $album->id] , ['user_id', Auth::id()] ])->first();
        if(!$album){
            return abort(404);
        }

        // Delete Record from DB
        try {
            $delete = $album->delete();
                return redirect() -> route('home')-> with( [ "success" => " Album deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route('home')-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route('home')-> with( [ "failed" => "Error at delete opration"] ) ;
        }
    }
}
