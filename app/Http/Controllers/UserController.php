<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $usuarios =  $this->user->get();

        return view('usuarios.index', compact('usuarios'));
    }
}
