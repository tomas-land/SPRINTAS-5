@extends('layouts.nav')
@section('content')

    <div class="pt-4">
        <h3>Projects</h3>
        <hr>
<div class="row">
<div class="col-2">id</div>
<div class="col-5">project-title</div>
<div class="col">name</div>
<div class="col">actions</div>

</div>



        @foreach ($projects as $project)
            <hr>
            
            <div class="row">
                <div class="col-2">
                    {{ $loop->iteration }}
                </div>
                <div class="col-5">
                    {{ $project['title'] }}

                </div>
                <div class="col">
                    @foreach ($project->employees as $employee)
                                    {{ $employee['name'] }}
                                   
                                @endforeach
                </div>
                <div class="col">
                       <div class="btn-group" style="overflow: auto">
                        <form style='float: left;' action="{{ route('projects.destroy', $project['id']) }}"
                            method="POST">
                            @method('DELETE') @csrf
                            <input class="btn-secondary mr-1" type="submit" value="DELETE">
                        </form>
                        <form style='float: left;' action="{{ route('projects.show', $project['id']) }}"
                            method="GET">
                            <input class="btn-secondary" type="submit"  value="UPDATE">
                        </form>
                    </div> 
                </div>
            </div>

        @endforeach
    </div>
    <br>
    <form method="POST" action="/projects">
        @csrf
        <label for="title">Project title:</label><br>
        <input type="text" id="title" name="title">  @error('title')<span style="color: rgb(54, 40, 182)">{{ $message }}</span>@enderror
        <br><br>
        <input class="btn btn-primary" type="submit" value="Add project">
    </form>
<br><br>
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif

  {{var_dump($project->employees)}}

@endsection


