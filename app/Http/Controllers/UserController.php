<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\UsuariosRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    /**
     *
     */
    public function __construct(
                                    User $user
                                )
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios =  $this->user->where('activo', 1)->get();

        return view('usuarios.index', compact('usuarios'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest $request)
    {

        $this->user::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'activo' => 1,
        ]);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 0) {
            return view('usuarios.create');
        } else {
            $usuario = $this->user->where('id', $id)->first();

            return view('usuarios.edit', compact('usuario'));
        }
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
        /*
         * Si el pass, viene vacio no lo actualizamos
         */
        if ($request->password != NULL )
        {
           $this->user::where( 'id', $id )
                                        ->update([
                                            'name' => $request->nombre,
                                            'email'   => $request->correo,
                                            'password' => Hash::make( $request->password ),
                                            'tipo' => $request->tipo
                                        ]);
       }
       else
       {
        $this->user::where( 'id', $id )
                                    ->update([
                                        'name' => $request->nombre,
                                        'email'   => $request->correo,
                                        'tipo' => $request->tipo
                                    ]);
       }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user::where('id', $id)
                    ->update(['activo' => 0]);
    }
}
