<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
  
class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from laraveia.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('mobilegayan@gmail.com')->send(new SendMail($mailData));
           
        //dd("Email is sent successfully11.");
    }
}