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
        $json = '{
            "env": {
              "terminalType": "APP"
            },
            "orderTags": {
              "ifProfitSharing": true
            },
            "merchantTradeNo": "9825382937292",
            "orderAmount": 25.17,
            "currency": "USDT",
            "description": "very good Ice Cream",
            "goodsDetails": [{
              "goodsType": "01",
              "goodsCategory": "D000",
              "referenceGoodsId": "7876763A3B",
              "goodsName": "Ice Cream",
              "goodsDetail": "Greentea ice cream cone"
            }]
          }';

        $body = json_decode($json);

        $payload = $timestamp . "\n" . $nonce . "\n" . $json . "\n";
        $signature = strtoupper(hash_hmac("SHA512", $payload, config('app.binancePayApiSecret')));

        $reponse =  $this->binance->request('POST','order', [
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
