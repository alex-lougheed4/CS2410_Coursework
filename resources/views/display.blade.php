@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
            <div class="card-header">Dashboard</div>
              <div class="card-body">

                @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                @endif
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Pet Species | </th>
                      <th>Pet Breed | </th>
                      <th>Pet Sex | </th>
                      <th>Pet DOB | </th>
                      <th>Pet Name | </th>
                      <th>Pet Status</th>
                    </tr>
                  </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
