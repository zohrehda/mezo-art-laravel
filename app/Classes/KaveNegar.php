<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class KaveNegar
{
    public $api_key;
    public $host;

    public function __construct()
    {
        $this->api_key = config('kavenegar.api_key');
        $this->host = config('kavenegar.host');
    }

    public function getBaseUrl()
    {
        return $this->host . '/v1/' . $this->api_key;
    }

    public function send($to, $message)
    {
        $response = Http::get($this->getBaseUrl() . '/sms/send.json', [
            'receptor' => $to,
            'message' => urlencode($message),
        ]);
        if ($response->status() !== 200) {
            //throw new \ErrorException($response->body());
        }
    }

    public function verify($to, $otp)
    {
        $response = Http::get($this->getBaseUrl() . '/verify/lookup.json"', [
            'receptor' => $to,
            'token' => $otp,
            'template' => 'verify',
        ]);
        if ($response->status() !== 200) {
            throw new \ErrorException($response->body());
        }
    }

}
