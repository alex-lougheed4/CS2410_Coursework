@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Edit and update the animal</div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br />
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('animals.update', ['animal' =>
            $animal['id']]) }}" enctype="multipart/form-data" >
            @method('PATCH')
            @csrf
            <div class="col-md-8">
              <label >Animal Species</label>
              <input type="text" name="petSpecies" value="{{$animal->petSpecies}}"/>
            </div>
            <div class="col-md-8">
              <label >Animal Breed</label>
              <input type="text" name="petBreed" value="{{$animal->petBreed}}"/>
            </div>
            <div class="col-md-8">
              <label >Animal Sex</label>
              <input type="text" name="petSex" value="{{$animal->petSex}}"/>
            </div>
            <div class="col-md-8">
              <label >Animal Date Of Birth</label>
              <input type="text" name="petDOB" value="{{$animal->petDOB}}"/>
            </div>
            <div class="col-md-8">
              <label >Animal Name</label>
              <input type="text" name="petName" value="{{$animal->petName}}"/>
            </div>
            <div class="col-md-8">
              <label >Animal Status</label>
              <input type="text" name="petStatus" value="{{$animal->petStatus}}"/>
            </div>
            <div class="col-md-8">
              <label >Description</label>
              <textarea rows="4" cols="50" name="description" > {{$animal->description}}
              </textarea>
            </div>
            <div class="col-md-8">
              <label>Image</label>
              <input type="file" name="image" />
            </div>
            <div class="col-md-6 col-md-offset-4">
              <input type="submit" class="btn btn-primary" />
              <input type="reset" class="btn btn-primary" />
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
