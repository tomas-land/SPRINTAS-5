@extends('layouts.nav')
@section('content')



    <div class="pt-4">
        <h3>Employees</h3>
        <hr>
        <div class="row">
            <div class="col-2">id</div>
            <div class="col-5">name</div>
            <div class="col">project-title</div>
            <div class="col">actions</div>

        </div>



        @foreach ($employees as $employee)
            <hr>
            <div class="row">
                <div class="col-2">
                    {{ $loop->iteration }}
                </div>
                <div class="col-5">
                    {{ $employee['name'] }}

                </div>
                <div class="col">
                    {{ $employee->project['title'] }}
                </div>
                <div class="col">
                    <div class="btn-group" style="overflow: auto">
                        <form style='float: left;' action="{{ route('employees.destroy', $employee['id']) }}"
                            method="POST">
                            @method('DELETE') @csrf
                            <input class="btn-secondary mr-1" type="submit" value="DELETE">
                        </form>
                        <form style='float: left;' action="{{ route('employees.show', $employee['id']) }}" method="GET">
                            <input class="btn-secondary" type="submit" value="UPDATE">
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
    <br>
    <form method="POST" action="/employees">
        @csrf
        <label for="name">Add new employee:</label><br>
        <input type="text" id="name" name="name"> @error('title')<span
            style="color: rgb(54, 40, 182)">{{ $message }}</span>@enderror
        <br><br>

        <label for="assign">Assign project:</label>

        <select name="assign">
            <option selected disabled>Select project</option>
            @foreach ($projects as $project)
                <option value="{{ $project['id'] }}"> {{ $project['title'] }} </option>
            @endforeach
        </select>
        <input class="btn btn-primary" type="submit" value="Add">

    </form>
    <br><br>
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif










@endsection
