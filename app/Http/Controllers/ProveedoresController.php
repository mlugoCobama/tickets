<?php

namespace App\Http\Controllers;

use App\Models\ProveedoresModel;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    private $proveedores;
    /**
     *
     */
    public function __construct(
                                    ProveedoresModel $proveedores
                                )
    {
        $this->proveedores = $proveedores;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores =  $this->proveedores->get();

        return view('proveedores.index', compact('proveedores'));
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
