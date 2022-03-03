@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 rounded p-3 bg-white">
                <div class="mb-2">
                    <h3 class="mb-0">Create new skill</h3>
                </div>
                <form action="{{ route('skills/store') }}" method="post">
                    @csrf
                    <div class="form-group mb-3 col-md-5 px-0">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div>
                        <button class="bg-success py-1 px-3 rounded text-white border-0">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
