@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all Adoption Requests</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pet ID | </th>
                <th>Requesting User ID | </th>
                <th>Adoption Status </th>
              </tr>
            </thead>
            <tbody>
              @foreach($adoptions as $adoption)
              <tr>
                @if( (Auth::id() == $adoption['requesterUserID']) || ( Auth::user()->role == 1) )
                <td>{{$adoption['petID']}}</td>
                <td>{{$adoption['requesterUserID']}}</td>
                <td>{{$adoption['adoptionStatus']}}</td>
                @endif
                @if( ($adoption['adoptionStatus'] == "pending") &&  ( Auth::user()->role == 1)  )
                <td><a href="{{route('approve', ['id' => $adoption['id'] ] )}}" class="btn btnprimary">Approve</a></td>
                <td><a href="{{route('deny', ['id' => $adoption['id'] ] )}}" class="btn btnprimary">Deny</a></td>
                @endif
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
