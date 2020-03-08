<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class googleCaptchController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function store(Request $request){
        $token = $request->input('g-recaptcha-response');
        if($token){
            $client = new Client();
            $response = $client->post("https://www.google.com/recaptcha/api/siteverify",[
               'form_params' => [
                   'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                   'response' => $token
               ]
            ]);
            $body = json_decode($response->getBody()->getContents());
            var_dump($body);
        }
        $request->validate([
            'g-recaptcha-response' => 'required'
        ]);
    }

}
