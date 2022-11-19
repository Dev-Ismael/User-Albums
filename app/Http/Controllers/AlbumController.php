<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\Album\StoreAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
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
                return redirect() -> route('home') -> with( [ "success" => " Album store successfully"] ) ;
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
        $album = Album::where('id',$album->id)->first();
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
        $album = Album::findOrFail($album->id);
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
        $album = Album::findOrFail($album->id);

        // save all request in one variable
        $requestData = $request->all();

        // Store in DB
        try {
            $update = $album-> update( $requestData );
                return redirect() -> route('home') -> with( [ "success" => " Album store successfully"] ) ;
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
        $album = Album::findOrFail($album->id);

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
