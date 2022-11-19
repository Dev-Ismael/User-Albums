@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header"> Edit Album </div>

                    <div class="card-body">

                        <form action="{{ route('album.update', $album->id) }}" method="POST">

                            @csrf
                            @method("PUT")

                            <!------ name ------>
                            <div class="form-group">
                                <label for="name"> Album Name </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Type Name..."
                                    value="{{old('name', $album->name)}}"/>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}.</div>
                                @enderror
                            </div>

                            <!------ Submit Btn ------>
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary mt-3">
                                    <span>Submit Now</span>
                                </button>
                            </div>

                        </form>

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
