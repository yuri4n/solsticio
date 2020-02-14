<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\UserMail;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function complete()
    {
        $user = User::orderBy('id', 'DESC')->where('status', 'APPROVED')->paginate(25);
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     * @throws ValidationException
     */
    public function updateAndNotify(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'user' => 'required',
        ]);

        $user = $request->user;

        $data = array(
            'user' => $user,
            'status' => $request->status,
        );

        User::find($id)->update(['status' => $request->status]);

        Mail::to($user['email'])->send(new UserMail($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return void
     * @throws ValidationException
     */
    public function rejectAndNotify(Request $request, $id)
    {
        $this->validate($request, [
            'user' => 'required'
        ]);

        $user = $request->user;

        $data = array(
            'user' => $user,
            'status' => 'REJECTED',
        );

        Mail::to($user['email'])->send(new UserMail($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
    }
}
