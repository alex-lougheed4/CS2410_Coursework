@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all animals</div>
        <div class="card-body">
          <form method="GET" action="{{ route('sortby', ['sort' => 'petName']) }}">
            @csrf
            <input name="sort_name" type="hidden" value="name">
            <button class="btn" type="Sort">Sort by name</button>
          </form>
          <form method="GET" action="{{ route('sortby', ['sort' => 'petDOB']) }}">
            @csrf
            <input name="sort_DOB" type="hidden" value="dob">
            <button class="btn" type="Sort">Sort by Date Of Birth</button>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pet Species | </th>
                <th>Pet Breed | </th>
                <th>Pet Sex | </th>
                <th>Pet DOB | </th>
                <th>Pet Name | </th>
                @if( Auth::user()->role == 1)
                <th>Pet Status | </th>
                <th>Pet Owner </th>
                @else
                <th>Pet Status </th>
                @endif

              </tr>
            </thead>
            <tbody>
              @foreach($animals as $animal)
              <tr>
                <td>{{$animal['petSpecies']}}</td>
                <td>{{$animal['petBreed']}}</td>
                <td>{{$animal['petSex']}}</td>
                <td>{{$animal['petDOB']}}</td>
                <td>{{$animal['petName']}}</td>
                <td>{{$animal['petStatus']}}</td>
                @if( Auth::user()->role == 1)
                <td>{{$animal['petOwner']}}</td>
                @endif
                <td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btnprimary">Details</a></td>
                @if( Auth::user()->role == 1)
                <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btnwarning">Edit</a></td>
                @endif
                <td>
                  <form method="POST" action="{{ route('create_adoption', ['animal' => $animal['id']]) }}">
                  @csrf
                  <input name="animal" type="hidden" value="{{$animal['id']}}">
                  @if( ($animal['petStatus'] == "available") && ( Auth::user()->role == 0))
                  <button class="btn btn-danger" type="submit"> Adopt</button>
                  @endif
                </form>
              </td>
                <td>
                  <form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],
                  ['animal' => $animal['id']]) }}" method="post">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  @if( Auth::user()->role == 1)
                  <button class="btn btn-danger" type="submit"> Delete</button>
                  @endif
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection
