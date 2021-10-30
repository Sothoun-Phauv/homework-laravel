<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User::findOrFail($id);
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
    public function destroy($id)
    {
        //
    }
    public function register(Request $request){
        //
        $request->validate([
            'password' => 'required|confirmed'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $token = $user->createToken('myToken')->plainTextToken;
        return response()->json([
            'user' =>$user,
            'token' => $token
        ],201);
    }
    public function login(Request $request)
    {
        # code...
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["Message" => "Bad login"], 201);
        }
        $token = $user->createToken('myToken')->plainTextToken;
        return response()->json(
            [
                'user' => $user,
                'token'=>$token
            ],
            201);
    }
    public function logout(Request $request)
    {
        # code...
        auth()->user()->tokens()->delete();
        return response()->json(['Message'=>'Signing out'],201);
    }


}
