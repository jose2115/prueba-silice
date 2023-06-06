<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Response;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function index()
    {

        $users = User::all();
        return view('dashboard', compact('users'));
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de usuarios
    }

    public function store(Request $request)
    {
        // Lógica para guardar un nuevo usuario en la base de datos
    }

    public function show($id)
    {
        // Lógica para mostrar un usuario específico
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('auth.edit-register' , compact('user','roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {

        try {

            DB::beginTransaction();

                $user = User::findOrFail($id);
                $user->name        = $request->name;
                $user->full_name   = $request->full_name;
                $user->email       = $request->email;
                $user->nif         = $request->nif;
                $user->save();

                $user->syncRoles([$request->rol]);

            DB::commit();
    
            return redirect(RouteServiceProvider::HOME);

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al editar el usuario.');
        }  

    }

    public function destroy($id)
    {
        try {
                $user = User::findOrFail($id);
    
                if ($user->id === Auth::id()) {
                    $message = 'No puedes eliminar tu propio usuario.';
                    return response()->json(['message' => $message], 403);
                }
    
            DB::beginTransaction();
                $user->delete();
        
                $message = 'Usuario eliminado con éxito.';

            DB::commit();
            return response()->json(['message' => $message]);

        } catch (\Exception $e) {

            DB::rollBack();
            $message = 'Ocurrió un error al eliminar el usuario.';
            return response()->json(['message' => $message], 500);

        }
    }
}
