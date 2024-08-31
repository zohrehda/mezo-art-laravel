<?php

namespace App\Classes;


use Illuminate\Support\Facades\Http;

class ZarinPal
{
    public $merchant_id;
    public $result_url;
    public $verify_url;
    public $start_pay_url;
    public $description;
    public $callback_url;

    public static $success_status = 'success';
    public static $failure_status = 'failure';


    public function __construct()
    {
        $env = config('zarinpal.env');
        $this->merchant_id = config('zarinpal.merchant_id');
        $this->description = trans('message.zarinpal_description');
        $this->callback_url = route('app.payment.callback');

        $this->result_url = config("zarinpal." . $env . ".result");
        $this->verify_url = config("zarinpal." . $env . ".verify");
        $this->start_pay_url = config("zarinpal." . $env . ".start_pay");

    }

    public function result($amount, callable $callback = null)
    {
        $response = Http::post($this->result_url, [
            'merchant_id' => $this->merchant_id,
            'amount' => $amount,
            'description' => $this->description,
            'callback_url' => $this->callback_url,

        ]);
        if ($response->failed()) {
            return api_response([
                'status' => 500,
                'message' => 'something went wrong',
            ]);
        }

        $response = $response->json();

        if (empty($response['errors']) and $response['data']['code'] == 100) {

            $authority = $response['data']["authority"];
            $gateway = $this->createGateWay($authority);
            if ($callback) {
                $callback($authority);
            }
            return api_response([
                'status' => 201,
                'result' => [
                    'gateway' => $gateway
                ],
            ]);

        } else {
            return api_response([
                'status' => 422,
            ]);
        }
    }

    private function createGateWay($authority): string
    {
        return $this->start_pay_url . "/$authority";
    }

    public function verify($status, $amount, $authority, callable $callback)
    {
        if (!$authority or !in_array($status, ['OK', 'NOK'])) {
            dd('invalid request');
            echo 'invalid request';
        }

        $status = ($status == 'OK') ? self::$success_status : self::$failure_status;

        if ($status == self::$success_status) {
            $response = Http::post($this->verify_url, [
                'merchant_id' => $this->merchant_id,
                'authority' => $authority,
                'amount' => $amount
            ]);

            if ($response->failed()) {
                return api_response([
                    'status' => 500,
                    'message' => 'something went wrong',
                ]);
            }

            $response_data = (empty($response['errors']) and $response['data']['code'] == 100) ? $response['data'] : [];
        }

        return $callback($status, [
            'ref_id' => $response_data['ref_id'] ?? null,
            'fee' => $response_data['fee'] ?? null,
            'fee_type' => $response_data['fee_type'] ?? null,
            'card_hash' => $response_data['card_hash'] ?? null,
            'card_pan' => $response_data['card_pan'] ?? null,
        ]);
    }


}
