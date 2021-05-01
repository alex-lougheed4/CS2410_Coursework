@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all animals</div>
        <div class="card-body">
          <table class="table table-striped" border="1" >
            <tr> <td> <b>Animal Species </th> <td> {{$animal['petSpecies']}}</td></tr>
              <tr> <th>Animal breed </th> <td>{{$animal['petBreed']}}</td></tr>
              <tr> <th>Animal sex </th> <td>{{$animal['petSex']}}</td></tr>
              <tr> <td>Animal Date Of Birth </th> <td>{{$animal['petDOB']}}</td></tr>
              <tr> <td>Animal Name </th> <td>{{$animal['petName']}}</td></tr>
              <tr> <td>Animal Status </th> <td>{{$animal['petStatus']}}</td></tr>
              <tr> <th>Notes </th> <td style="max-width:150px;" >{{$animal->description}}</td></tr>
              <tr> <td colspan='2' ><img style="width:100%;height:100%"
                src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
              </table>
              <table><tr>
                <td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the
                  list</a></td>
                  @if( Auth::user()->role == 1)
                  <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btnwarning">Edit</a></td>
                  <td><form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}"
                    method="post"> @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>
                    @endif
                  </form></td>
                </tr></table>
              </div>
            </div>
          </div>
        </div>
</div>
@endsection