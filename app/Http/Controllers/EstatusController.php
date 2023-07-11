<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstatusModel;
class EstatusController extends Controller
{
    private $estatus;
    /**
     *
     */
    public function __construct(
                                    EstatusModel $estatus
                                )
    {
        $this->estatus = $estatus;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estatus =  $this->estatus->get();

        return view('estatus.index', compact('estatus'));
    }
}
