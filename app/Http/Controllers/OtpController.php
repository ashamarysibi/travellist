<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use Hash;
use Twilio\Rest\Client;
class OtpController extends Controller
{

private function sendMessage($message, $recipients)
{
    $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );
}
public function sendCustomMessage(Request $request)
{
    
    $user_id = Auth::user()->id;  
    $phone = DB::table('users')->where('id', $user_id)->value('phone_number');
    $random= rand(100000, 999999);
    $data = $random.' '. "is the OTP for user Authentication ";    
    $otp = Hash::make($random);
    $users = new User();
    $users->otp = $data;    
    DB::table('users')->where('id', '=' , $user_id)->update(['otp' => $otp]);
    $recipients = $phone;  
    $this->sendMessage($data, $recipients);    
   return Redirect::back()->with('success', 5);
}
}
