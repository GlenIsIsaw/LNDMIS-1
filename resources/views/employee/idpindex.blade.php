@extends('layout')


@section('content')
<form action="{{route('idp.empindex')}}">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
      <div class="absolute top-4 left-3">
        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
      </div>
      <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"/>
      <div class="absolute top-2 right-2">
        <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-900 hover:bg-black-600">
          Search
        </button>
      </div>
    </div>
  </form>
  
  <form action="{{route('idp.empindex')}}">
    <div class="text-center mt-6">
      <label for="start_date" class="inline-block text-lg mb-2">
          Start Date
      </label>
      <input
          type="date"
          name="start_date"
        />
      <label for="end_date" class="inline-block text-lg mb-2">
          End Date
      </label>
      <input
          type="date"
          name="end_date"
        />
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Filter</button>
    </div>
  </form>
  <div class="text-left mt-6">
<h1 class="text-lg font-bold uppercase ml-6">List of {{auth()->user()->name}}'s Individual Development Plan</h1>
  </div>


@foreach ($idps as $idp)
    @php
        $pieces = explode("-", $idp->created_at);
    @endphp
    <p><a href="{{route('idp.show',$idp->idp_id)}}">{{$idp->name}}'s Individual Development Plan For Year {{$pieces[0]}}</a></p>
@endforeach

<div class="text-center mt-6">
<a href="{{route('idp.create')}}"><button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"></i>Create</a>
</button>
</div>
@endsection