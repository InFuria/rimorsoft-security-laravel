<?php

namespace App\Http\Controllers;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::get();

        return view('users.edit', compact('user','roles'));
    }


    public function update(Request $request, User $user)
    {
        //actualiza el usuario
        $user->update($request->all());

        //actualizar los roles
        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.edit', $user->id)->with('info', 'Usuario actualizado con exito');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'Usuario Eliminado correctamente');
    }
}
