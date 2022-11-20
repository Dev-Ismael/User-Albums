@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header"> Album  <strong> {{ $album->name }} </strong> </div>

                    <div class="card-body">

                        <form action="{{ route("image.store", [ 'album' => $album ]) }}" method="POST" class="dropzone mt-2" id="my-awesome-dropzone">
                            @csrf
                        </form>

                    </div>


                </div>

                <!--------------- Session Alert ----------------->
                <div class="container">
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2 text-center" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('failed'))
                        <div class="alert alert-danger mt-2 text-center" role="alert">
                            {{ session()->get('failed') }}
                        </div>
                    @endif
                </div>

                <!------ index images ------->
                <div class="row mt-3">
                    @foreach ( $album->images as $image )
                        <div class="col-md-6 mt-3">

                            <div class="card w-75 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('image.show' , $image->id ) }}">
                                            <img src="{{ asset("images/".$image->name) }}" alt="album-img" class="img-fluid rounded">
                                        </a>
                                    </h5>

                                    <!------ Show ------->
                                    <a href="{{ route("image.show", $image->id) }}" class="btn btn-dark">View</a>
                                    &nbsp;

                                    <!------ Delete ------->
                                    <a href="{{ route("image.destroy", $image->id) }}"
                                        class="btn btn-danger delete-image"> Delete </a>

                                    <form id="delete-image" action="{{ route("image.destroy", $image->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method("DELETE")
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
