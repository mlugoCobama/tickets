<?php

namespace App\Http\Controllers;

use App\Models\AreasModel;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    private $areas;
    /**
     *
     */
    public function __construct(
                                    AreasModel $areas
                                )
    {
        $this->areas = $areas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas =  $this->areas->get();

        return view('areas.index', compact('areas'));
    }
}
