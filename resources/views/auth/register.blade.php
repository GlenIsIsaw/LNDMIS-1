@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="inline-block text-lg mb-2">
                                Name
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="name"
                                value = "{{old('name')}}"
                            />
                        </div>
                        
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="teacher" class="inline-block text-lg mb-2">
                                Teacher
                            </label>
                            <select name="teacher" id="teacher">
                                <option value=""></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                              </select>

                            </div>

                        @error('teacher')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="position" class="inline-block text-lg mb-2">
                                Position
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="position"
                                value = "{{old('position')}}"
                            />
                        </div>
                        @error('position')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <div class="mb-6">
                            <label for="yearinPosition" class="inline-block text-lg mb-2">
                                Year In Position
                            </label>
                            <input
                                type="date"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="yearinPosition"
                                
                            />
                            @error('yearinPosition')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        <div class="mb-6">
                            <label for="college" class="inline-block text-lg mb-2">
                                College/Department
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="college"
                                value = "{{old('college')}}"
                            />
                        </div>

                        @error('college')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="supervisor" class="inline-block text-lg mb-2">
                                Supervisor
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="supervisor"
                                value = "{{old('supervisor')}}"
                            />
                        </div>

                        @error('supervisor')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="year" class="inline-block text-lg mb-2">
                                Year Joined
                            </label>
                            <input
                                type="date"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="yearJoined"
                                
                            />
                        </div>
                        @error('yearJoined')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email"
                                value = "{{old('email')}}"
                            />

                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror

                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
