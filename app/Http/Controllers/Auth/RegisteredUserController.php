<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $role = Role::all();
        return view('auth.register' , compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();
    
            $user = User::create([
                'name'      => $request->name,
                'full_name' => $request->full_name,
                'email'     => $request->email,
                'nif'       => $request->nif,
                'password'  => Hash::make($request->password),
            ]);
    
            $user->assignRole($request->rol);
    
            DB::commit();
    
            return redirect(RouteServiceProvider::HOME);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al crear el usuario.');
        }
    }
}
