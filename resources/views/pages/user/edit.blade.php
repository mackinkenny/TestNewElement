@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 rounded p-3 bg-white">
                <div class="mb-2">
                    <h3 class="mb-0">Edit user</h3>
                </div>
                <form action="{{ route('users/update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group mb-3 col-md-5 px-0">
                        <label for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $user->name }}" required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-5 px-0">
                        <label for="name">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ $user->email }}" required>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-5 px-0">
                        <label for="name">Phone</label>
                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{ $user->phone }}" required>

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-5 px-0">
                        <p class="mb-1">Position</p>
                        <select class="w-100 @error('position_id') is-invalid @enderror" name="position_id" id="position_id" required>
                            @foreach($positions as $position)
                                <option value="{{$position->id}}">{{ $position->name }}</option>
                            @endforeach
                        </select>

                        @error('position_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 col-md-5 px-0">
                        <p class="mb-1">Skills</p>
                        <select class="w-100 " name="skills" id="skills" data-max-values="5" required>
                            @foreach($skills as $skill)
                                <option value="{{$skill->id}}">{{ $skill->name }}</option>
                            @endforeach
                        </select>

                        @error('skills')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div>
                        <button class="bg-success py-1 px-3 rounded text-white border-0">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        VirtualSelect.init({
            ele: '#position_id'
        });

        VirtualSelect.init({
            ele: '#skills',
            multiple: true,
        });
    </script>
@endpush
