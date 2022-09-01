<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show()
    {
        $oClient = Client::account('default');
        $oClient->connect();

        $aFolder = $oClient->getFolders();

        /*
        $host = "{open.cobama.com.mx:143}";
        $user = "tickets@cobama.com.mx";
        $pass = "Mhtemplos2022+";


        $conn = imap_open($host, $user,$pass) or die("can't connect: " . imap_last_error());

        $mailsNoLeidos = imap_search($conn, 'ALL');

        echo "<h1> MESSAGE</h1>\n";
        print_r($mailsNoLeidos);
        echo "<h1>*************</h1>\n";
        */

    }
}
