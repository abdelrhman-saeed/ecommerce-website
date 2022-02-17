<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|size:11',
        ]);

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);

        Auth::login($user = User::create($user));
        Event::dispatch(new Registered($user));

        return redirect(route('verification.notice'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return view('users.profile', ['user' => $user]);
        }
        return response('Unauthorized', 401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.profile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id === auth()->user()->id) {

            $request->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required|size:11'
            ]);
            
            try {
                $user->update($request->all());
            }
            catch(QueryException $e) {
                return back()->withErrors([
                    'email' => 'this email has registred before'
                ]);
            }
            return back();
        }
        return response('unauthorized', 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->user()->id) {
            $user->delete();
        }
        
        return redirect('/home');
    }
}
