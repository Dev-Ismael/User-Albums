@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header"> Image Details </div>
                    <div class="card-body">

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



                        <form action="{{ route('image.update', $image->id) }}" method="POST">

                            @csrf

                            <!------ name ------>
                            <div class="form-group">
                                <label for="name"> Album Name </label>
                                <select name="album_id" class="form-control" id="album_id">
                                    @foreach ( $albums as $album )
                                        <option value="{{ $album->id }}" @if ( $image->album->id == $album->id ) selected @endif >
                                            {{ $album->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('album_id')
                                    <div class="invalid-feedback d-block">{{ $message }}.</div>
                                @enderror
                            </div>

                            <!------ Submit Btn ------>
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-primary mt-2 mb-5">
                                    <span>Submit Now</span>
                                </button>
                            </div>

                        </form>

                        <img src="{{ asset("storage/images/".$image->name) }}" alt="album-img" class="img-fluid rounded">

                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
