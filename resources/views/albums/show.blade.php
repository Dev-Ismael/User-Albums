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

                <!------------->
                <div class="row mt-3">
                    @foreach ( $album->images as $image )
                        <div class="col-md-6 mt-3">
                            <a href="{{ route('image.show' , $image->id ) }}">
                                <img src="{{ asset("images/".$image->name) }}" alt="album-img" class="img-fluid rounded">
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
