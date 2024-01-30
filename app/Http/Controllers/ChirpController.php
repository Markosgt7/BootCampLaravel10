<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index', [
            /* esto ser puede hacer tambien de las siguiente forma
            además se agrega el with para evitar el problema N+1 que por cada dato de mi lista se genere una consulta
            ya que esto genera problema de rendimiento en el sistema. */
            //'chirps' => Chirp::orderBy('created_at','desc')->get()
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'message' => 'required|min:5| max:255'
        ]);

        $request->user()->chirps()->create($validated);
        
        return to_route('chirps.index')->with('status',__('Chirp created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
       /*  if (auth()->user()->isNot($chirp->user)){
            abort(403);
        } */
        return view('chirps.edit',[
            'chirp'=>$chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {   
        $this->authorize('update', $chirp);
        /* if (auth()->user()->isNot($chirp->user)){
            abort(403);
        } */
         // Validate request
         $validated = $request->validate([
            'message' => 'required|min:5| max:255'
        ]);
        $chirp->update($validated);
        return to_route('chirps.index')->with('status',__('Chirp updated succesfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return back()->with('status', __('Chirp deleted successfully!'));    
    }
}
