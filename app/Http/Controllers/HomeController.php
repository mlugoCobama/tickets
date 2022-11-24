<?php

namespace App\Http\Controllers;

use App\Mail\CorreoPrueba;
use Illuminate\Support\Facades\Mail;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        //Mail::to('ingmchlugo@gmail.com')->send( new CorreoPrueba() );

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        //try {

            // Email server settings
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');   //  sender username
            $mail->Password = env('MAIL_PASSWORD') ;      // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('tickets@cobama.com.mx', 'Sistema de Tickets');
            $mail->addAddress('ingmchlugo@gmail.com');

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = 'Correo de Prueba';
            $mail->Body    = 'Hola si te llega este mensaje el correo esta correctamente configurado.';

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return "faile Email not sent.";
            }

            else {
                return "success Email has been sent.";
            }

        //} catch (Exception $e) {
        //     return 'error Message could not be sent.';
        //}

    }
}
