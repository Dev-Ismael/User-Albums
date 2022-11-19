@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <button class="btn btn-success">Create New Album</button>
                    </div>

                </div>

                <div class="row mt-3">

                    <h2 class="text-center mb-2"> My Albums </h2>

                    <div class="col-md-4">
                        <div class="card w-75">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>

                                <a href="#" class="btn btn-primary">View...</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card w-75">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>

                                <a href="#" class="btn btn-primary">View...</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card w-75">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>

                                <a href="#" class="btn btn-primary">View...</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
