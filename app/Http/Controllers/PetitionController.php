<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\PetitionMail;
use App\Petition;
use App\User;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function approved()
    {
        $petitions = Petition::orderBy('id', 'DESC')->where('status', 'APPROVED')->paginate(25);
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'petition' => 'required',
        ]);

        $petition = $request->petition;
        $user = User::find($petition['user_id'])->first();

        $data = array(
            'user' => $user,
            'petition' => $petition,
            'status' => $request->status,
        );

        Petition::find($id)->update(['status' => $request->status]);

        Mail::to($user->email)->send(new PetitionMail($data));
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Petition $petition
     * @return Response
     */
    public function rejectNotify(Request $request, $id)
    {
        $this->validate($request, [
            'petition' => 'required'
        ]);

        $petition = $request->petition;
        $user = User::find($petition['user_id'])->first();

        $data = array(
            'user' => $user,
            'petition' => $petition,
            'status' => 'REJECTED',
        );

        Mail::to($user->email)->send(new PetitionMail($data));
    }
}
