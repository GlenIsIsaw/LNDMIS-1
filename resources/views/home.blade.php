@extends('layout')

@section('content')



<div class="w-fit h-fit flex justify-items-center left items-center">
    <div class="border border-black-20 w-50 h-50 justify-center items-center">
<button type="button" class="bg-laravel text-white rounded py-5 px-20 hover:bg-black rounded-lg">
    @if (auth()->user()->role_as == 0)
        <a href="#">List of Trainings</a>
    @else
        <a href="#">List of Trainings</a>
    @endif
    
</button>



<button type="button" class="bg-laravel text-white rounded py-5 px-20 hover:bg-black rounded-lg">
    @if (auth()->user()->role_as == 0)
        <a href="#">Individual Development Plan</a>
    @else
        <a href="#">Individual Development Plan</a>
    @endif
</button>
    </div>
</div>

@endsection
