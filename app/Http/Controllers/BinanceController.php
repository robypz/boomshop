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
        $this->baseUrl = "https://bpay.binanceapi.com/binancepay/openapi/v3/";
        $this->binance = new Client([
            'base_uri' => $this->baseUrl,
        ]);
    }

    public function makeOrder()
    {
        $timestamp = time() * 1000;
        $nonce = bin2hex(random_bytes(16));
        $body = json_encode(array(
            "env" => array(
                "terminalType" => "APP"
            ),
            "merchantTradeNo" => mt_rand(982538, 9825382937292),
            "orderAmount" => 25.17,
            "currency" => "USDT",
            "goods" => array(
                "goodsType" => "01",
                "goodsCategory" => "D000",
                "referenceGoodsId" => "7876763A3B",
                "goodsName" => "Ice Cream",
                "goodsDetail" => "Greentea ice cream cone"
            )
        ));

        $payload = $timestamp . "\n" . $nonce . "\n" . $body . "\n";
        $signature = strtoupper(bin2hex(hash_hmac("sha512", $payload, config('app.binancePayApiSecret'), true)));

        $reponse =  $this->binance->post('order', [
            'headers' => [
                'Content-Type' => 'application/json',
                'BinancePay-Timestamp' => $timestamp,
                'BinancePay-Nonce' => $nonce,
                'BinancePay-Certificate-SN' => config('app.binancePayApiKey'),
                'BinancePay-Signature' => $signature,
            ],

            'json' => $body,
        ]);

        print_r($reponse);
    }
}
