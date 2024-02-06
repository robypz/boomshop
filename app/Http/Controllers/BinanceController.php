<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BinanceController extends Controller
{
    private string $baseUrl;
    private Client $binance;

    public function __construct()
    {
        $this->baseUrl = "https://bpay.binanceapi.com/binancepay/openapi/";
        $this->binance = new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    public function createOrder()
    {
        $timestamp = time() * 1000;
        $nonce = bin2hex(random_bytes(16));

        $body = [
            "env" => [
                "terminalType" => "APP"
            ],
            "merchantTradeNo" => mt_rand(982538, 9825382937292),
            "orderAmount" => 25.17,
            "currency" => "USDT",
            "description" => "very good Ice Cream",
            "goodsDetails" => [[
                "goodsType" => "01",
                "goodsCategory" => "D000",
                "referenceGoodsId" => "7876763A3B",
                "goodsName" => "Ice Cream",
                "goodsDetail" => "Greentea ice cream cone"
            ]]
        ];

        $payload = $timestamp . "\n" . $nonce . "\n" . json_encode($body) . "\n";
        $signature = strtoupper(hash_hmac("SHA512", $payload, config('app.binancePayApiSecret')));

        $reponse =  $this->binance->post('v3/order', [
            'headers' => [
                'Content-Type' => 'application/json',
                'BinancePay-Timestamp' => $timestamp,
                'BinancePay-Nonce' => $nonce,
                'BinancePay-Certificate-SN' => config('app.binancePayApiKey'),
                'BinancePay-Signature' => $signature,
            ],

            'json' => $body,
        ]);

        echo $reponse->getBody();
    }

    public function webhook(Request $request)
    {
        $payload = $request->header('Binancepay-Timestamp') . "\n" . $request->header('Binancepay-Nonce') . "\n" . json_encode($request->all()) . "\n";

        $decodedSignature = base64_decode($request->header('Binancepay-Signature'));

        openssl_verify($payload, $decodedSignature, config('app.binancePayApiKey'), OPENSSL_ALGO_SHA256);

        return response()->json(["returnCode" => "SUCCESS", "returnMessage" => null], 200);
    }

    public function certificates()
    {

        $timestamp = time() * 1000;
        $nonce = bin2hex(random_bytes(16));

        $body = [];

        $payload = $timestamp . "\n" . $nonce . "\n" . json_encode($body) . "\n";
        $signature = strtoupper(hash_hmac("SHA512", $payload, config('app.binancePayApiSecret')));

        $reponse =  $this->binance->post('certificates', [
            'headers' => [
                'Content-Type' => 'application/json',
                'BinancePay-Timestamp' => $timestamp,
                'BinancePay-Nonce' => $nonce,
                'BinancePay-Certificate-SN' => config('app.binancePayApiKey'),
                'BinancePay-Signature' => $signature,
            ],

            'json' => $body,
        ]);

        $cartificates = json_decode($reponse->getBody());
        $cartificates = [
            'certPublic' => $cartificates['data']['certPublic'],
            'certSerial' => $cartificates['data']['certSerial'],
        ];

        print_r($cartificates);
    }
}
