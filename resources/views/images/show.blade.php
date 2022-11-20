@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header"> Image Details   </div>
                    <div class="card-body">

                        <img src="{{ asset("images/".$image->name) }}" alt="album-img" class="img-fluid rounded">

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
