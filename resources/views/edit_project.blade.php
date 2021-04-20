
@extends('layouts.nav')
@section('content')
    

<br>
<form action="{{ route('projects.update', $project['id']) }}" method="POST">
    @method('PUT') @csrf
    <label for="title">Edit title:</label><br>
    <input type="text" name="title" value="{{ $project['title'] }}"><br><br>
    <input class="btn btn-primary" type="submit" value="UPDATE">
</form>





@endsection
