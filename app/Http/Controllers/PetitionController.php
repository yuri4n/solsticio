<?php

namespace Solsticio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Solsticio\Petition;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $petitions = Petition::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $petitions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'nombre_responsable' => 'required',
            'cedula' => 'required',
            'additional' => 'required',
        ]);

        Petition::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Petition $petition
     * @return Response
     */
    public function show(Petition $petition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Petition $petition
     * @return Response
     */
    public function update(Request $request, Petition $petition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Petition $petition
     * @return Response
     */
    public function destroy($id)
    {
        $petition = Petition::find($id);
        if ($petition) {
            $petition->delete();
        }
    }
}
