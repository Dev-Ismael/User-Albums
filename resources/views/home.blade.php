@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                        &nbsp;
                        <a href="{{ route("album.create") }}" class="btn btn-success">Create New Album</a>
                    </div>

                    <!--------------- Session Alert ----------------->
                    <div class="container">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @elseif(session()->has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('failed') }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="row mt-3">

                    <h2 class="text-center mb-2"> My Albums </h2>

                    @if ($albums->isEmpty())
                        <!----------- No Data ------------->
                        <div class="alert alert-primary text-center" role="alert">
                            You don't have any albums in your profile, <a href="{{ route("album.create") }}">Create Album Now!</a>
                        </div>
                    @else
                        <!------ For Loop ------->
                        @foreach ( $albums as $album )
                            <div class="col-md-4">
                                <div class="card w-75 text-center">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{ $album ->name }} </h5>

                                        <!------ Show ------->
                                        <a href="{{ route("album.show", $album->id) }}" class="btn btn-dark">View</a>
                                        &nbsp;

                                        <!------ Edit ------->
                                        <a href="{{ route("album.edit", $album->id) }}" class="btn btn-primary">Edit</a>
                                        &nbsp;

                                        <!------ Delete ------->
                                        <a href="{{ route("album.destroy", $album->id) }}"
                                            class="btn btn-danger delete-album"> Delete </a>

                                        <form id="delete-album" action="{{ route("album.destroy", $album->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method("DELETE")
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>

            </div>
        </div>
    </div>
@endsection
