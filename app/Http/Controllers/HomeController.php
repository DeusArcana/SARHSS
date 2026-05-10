<?php

namespace App\Http\Controllers;

use App\Repositories\UnidadesRepository;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRoles(['local'])) {
            // Al no contar con permisos para ver otras unidades, redireccionamos
            // directamente a la unidad a la que pertenece.
            $unidades_repository = new UnidadesRepository;
            $user = $unidades_repository->getUnidadUser(Auth::user()->employee)['Unidad_Fisica'];

            return redirect(route('unidades.show', encode('unidades', $user)));
        } else {
            return view('home');
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating password change.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('auth.change_password');
    }

    /**
     * Update the password of the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        if (! (Hash::check($request->get('current-password'), Auth::user()->password))) {
            // Las contraseñas coinciden
            return redirect()->back()
                ->with('error', 'Su contraseña actual no coincide con la contraseña que proporcionó. Por favor, trate nuevamente.');
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // La contraseña actual y la proporcionada son iguales
            return redirect()->back()
                ->with('error', 'La nueva contraseña no puede igual a su contraseña actual. Favor de elegir una contraseña diferente.');
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        // Cambio de contraseña
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()
            ->with('success', '¡La contraseña ha sido cambiada exitosamente!');
    }
}
