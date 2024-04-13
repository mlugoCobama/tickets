<?php

namespace App\Http\Controllers;

use App\Models\DominiosModel;
use Illuminate\Http\Request;

class DominiosController extends Controller
{
    private $dominios;
    /**
     *
     */
    public function __construct(
                                    DominiosModel $dominios
                                )
    {
        $this->dominios = $dominios;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dominios =  $this->dominios
                    ->orderBy('fecha_renovacion', 'asc')
                    ->get();

        return view('dominios.index', compact('dominios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
