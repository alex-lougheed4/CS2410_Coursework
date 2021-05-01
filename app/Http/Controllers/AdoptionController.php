<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use Gate;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adoptions = Adoption::all()->toArray();
        return view('adoptions.index',compact('adoptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        store($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  int $animalID)
    {
      /**$adoption = $this->validate(request(), [
          'petID' => 'required',
          'requesterUserID' => 'required',
        ]);
        **/

        $adoption = new Adoption;
        $adoption->petID = $animalID;
        $adoption->requesterUserID  = Auth::id();
        $adoption->adoptionStatus = "pending";
        $adoption->created_at = now();

        $adoption->save();

        return back()->with('success', 'Adoption request has been made');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $adoption = Adoption::find($id);
      return view ('adoptions.show', compact('adoption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // call on admin button delete
    {
        $adoption = Adoption::find($id);
        $adoption->delete();
    }
    /**
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function approveAdoption($id) // call on confirm adoptiob button on Admin
    {
      $adoption = Adoption::find($id);
      $animal = Animal::find($adoption->petID);
      //dd($animal->petID);
      $adoption->adoptionStatus = "approved";
      $animal->petStatus = 'unavailable';
      $animal->petOwner = Auth::id();

      $animal->save();
      $adoption->save();

      return back()->with('success', 'Adoption request has been approved');
    }

    public function list(){
      return view('/list', array('adoptions' =>Adoption::all()));
    }

    public function display(){
      $adoptionsQuery = Adoption::all();
      if(Gate::denies('displayall')){
        $adoptionsQuery=$adoptionsQuery->where('userid',auth()->user()->id);
      }
      return view('/display',array('adoptions'=>$adoptionsQuery));
  }

  public function denyRequest($id){
    $adoption = Adoption::find($id);
    $animal = Animal::find($adoption->petID);
    $adoption->adoptionStatus = "denied";
    $animal->petOwner = "";
    $adoption->save();

    return back()->with('success', 'Adoption request has been denied');
  }




}
