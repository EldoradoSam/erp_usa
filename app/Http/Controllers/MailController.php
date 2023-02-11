<?php

namespace App\Http\Controllers;

use App\Mail\SMTPMail;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function sendMail()
    {

        $emails = Email::where('status', '=', 0)->get();
        foreach ($emails as $email) {
            if ($email) {
                $reciver = $email->reciever_email;
                $sender = $email->sender_email;
                $subject = $email->subject;
                $body = explode("<br>", $email->body);
                Mail::to($reciver)->send(new SMTPMail($subject, $body, $sender));
                if (!Mail::failures()) {
                    $email->status = 1;
                    $email->update();
                }
            }
        }
        return view('dashboard');
    }


    public static function createMail($subject, $mail_body, $sender, $reciever)
    {

        $email = new Email();
        $user_id = 0;
        if (Auth::user()->user_id != NULL) {
            $user_id = Auth::user()->user_id;
        }
        $email->user_id = $user_id;
        $email->sender_email = $sender;
        $email->reciever_email = $reciever;
        $email->subject = $subject;
        $email->body = $mail_body;
        $email->status = 0;
        $email->save();
    }
}
