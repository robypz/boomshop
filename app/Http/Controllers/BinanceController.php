<?php

namespace App\Http\Controllers;

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
        $timestamp = now()->getTimestampMs();
        $nonce = substr(str_shuffle(md5(microtime())), 0, 32);
        $body = json_encode([
            "env" => [
                "terminalType" => "WEB"
            ],
            "orderTags" => [
                "ifProfitSharing" => true
            ],
            "merchantTradeNo" => "9825382937292",
            "orderAmount" => 25.17,
            "currency" => "USDT",
            "description" => "very good Ice Cream",
            "goodsDetails" => [
                "goodsType" => "01",
                "goodsCategory" => "D000",
                "referenceGoodsId" => "7876763A3B",
                "goodsName" => "Ice Cream",
                "goodsDetail" => "Greentea ice cream cone"
            ]
        ]);

        $payload = $timestamp . "\n" . $nonce . "\n" . $body . "\n";

        $signature = hexdec(strtoupper(hash_hmac("sha512", $payload, config('app.binancePayApiSecret'))));

        $reponse =  $this->binance->post('order', [
            'headers' => [
                'content-type' => 'application/json',
                'Accept'     => 'application/json',
                'BinancePay-Timestamp' => $timestamp,
                'BinancePay-Nonce' => $nonce,
                'BinancePay-Certificate-SN' => config('app.binancePayApiKey'),
                'BinancePay-Signature' => $signature,
            ],

            'body' => $body,
        ]);

        print_r($reponse);
    }
}