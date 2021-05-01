<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Gate;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $sortType = $request->query('sort_name');
      if($sortType == "name"){
        $animals = Animal::all()
        ->sortBy('petName')
        ->toArray();
      }
      else if($sortType == "sort_DOB"){
        $animals = Animal::all()
        ->sortBy('petName')
        ->toArray();
      }
      else{
        $animals = Animal::all()->toArray();
      }
      return view('animals.index',compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form validation
        $animal = $this->validate(request(), [
          'petSpecies' => 'required',
          'petBreed' => 'required',
          'petSex' => 'required',
          'petDOB' => 'required',
          'petName' => 'required',
          'petStatus' => 'required',
          'description' => 'sometimes',
          'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
          'petOwner' => 'sometimes',
        ]);
        //Handles the uploading of the image
        if ($request->hasFile('image')){
          //gets the file name with it's extension
          $fileNameWithExt = $request->file('image')->getClientOriginalName();
          //gets just the file name
          $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
          //just gets the extension
          $extension = $request->file('image')->getClientOriginalExtension();
          //gets the filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;

          //Uploads the image
          $path =$request->file('image')->storeAs('public/images',$fileNameToStore);
        }
        else{
          $fileNameToStore = "noiamge.jpg";
        }

        //create an Animal object and set it's values from the input
        $animal = new Animal;
        $animal->petSpecies = $request->input('petSpecies');
        $animal->petBreed = $request->input('petBreed');
        $animal->petSex = $request->input('petSex');
        $animal->petDOB = $request->input('petDOB');
        $animal->petName = $request->input('petName');
        $animal->petStatus = $request->input('petStatus');
        $animal->description = $request->input('description');
        $animal->image = $fileNameToStore;
        $animal->petOwner = $request->input('petOwner');
        $animal->created_at = now();

        //Save the animal object
        $animal->save();
        //generate a redirect HTTP response with a success message
        return back()->with('success', 'Animal has been added');

        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $animal = Animal::find($id);
      return view ('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animal::find($id);
        return view('animals.edit',compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $animal =Animal::find($id);
        $this->validate(request(),[
          'petSpecies'=>'required',
          'petBreed'=>'required'
        ]);

        $animal->petSpecies = $request->input('petSpecies');
        $animal->description = $request->input('description');
        $animal->petBreed = $request->input('petBreed');
        $animal->petSex = $request->input('petSex');
        $animal->petDOB = $request->input('petDOB');
        $animal->petName = $request->input('petName');
        $animal->petStatus = $request->input('petStatus');
        $animal->updated_at = now();

        //Handles the uploading of the image
        if ($request->hasFile('image')){
          //Gets the filename with the extension
          $fileNameWithExt = $request->file('image')->getClientOriginalName();
          //just gets the filename
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
          //Just gets the extension
          $extension = $request->file('image')->getClientOriginalExtension();
          //Gets the filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          //Uploads the image
          $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
          $fileNameToStore = 'noimage.jpg';
        }

        $animal->image = $fileNameToStore;
        $animal->save();
        return redirect('animals');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();
        return redirect('animals');
    }

    public function list(){
      return view('/list', array('animals' =>Animal::all()));
    }

    public function display(){
      $animalsQuery = Animal::all();
      if(Gate::denies('displayall')){
        $animalsQuery=$animalsQuery->where('userid',auth()->user()->id);
      }
      return view('/display',array('animals'=>$animalsQuery));
  }

}
