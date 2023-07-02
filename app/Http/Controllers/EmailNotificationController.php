<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class EmailNotificationController extends Controller
{
    public function index()
    {
        $data = [
                'nama' => 'Farras Aldi',
                'website' => 'www.malasngoding.com',
        ];
        
        Mail::to("farasaldi30@gmail.com")->send(new EmailNotification($data));

        return "Email telah dikirim";
    }
}
