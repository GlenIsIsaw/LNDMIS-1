@extends('layout')


@section('content')

<h1>{{$training->certificate_title}}</h1>

<label for="name">Name</label>
<p>{{$training->name}}</p>
<label for="certificate_title">Training</label>
<p>{{$training->certificate_title}}</p>
<label for="certificate_type">Certificate Type</label>
<p>{{$training->certificate_type}}</p>
<label for="level">Level</label>
<p>{{$training->level}}</p>
<label for="venue">Venue</label>
<p>{{$training->venue}}</p>
<label for="sponsors">Sponsors</label>
<p>{{$training->sponsors}}</p>
<label for="date">Date Covered</label>
<p>{{$training->date_covered}}</p>
<label for="hours">Number of Hours</label>
<p>{{$training->num_hours}}</p>
<label for="type">Type</label>
<p>{{$training->type}}</p>
<label for="certificate">Certificate</label>
<img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
style="height: 100px; width: 150px;">

<a href="/trainings/{{$training->id}}/edit">
<i class="fa-solid fa-pencil"></i> Edit
</a>

<form method="POST" action="/trainings/{{$training->id}}">
@csrf
@method('DELETE')
<button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
</form>


@endsection