<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Payment;
use App\TempApplication;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cookie;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class BillingController extends Controller
{
    public function handlePayment()
    {
        $data = request()->json()->all();
        $orderId = $data['orderId'];
        $appId = $data['appId'];

        if ($orderId === null || $appId === null) {
            return abort(500, "No order ID and/or application ID received.");
        }

        $ppClient = PayPalClient::client();
        $ppResponse = $ppClient->execute(new OrdersGetRequest($orderId));

        $dClient = new Client();
        $headers = [
            'headers' => [
                'Authorization' => 'Bearer ' . Cookie::get('token')
            ]
        ];

        try
        {
            $dResponse = $dClient->get('https://discordapp.com/api/v6/users/@me', $headers);
        }
        catch (ClientException $exception)
        {
            return abort(403);
        }

        $responseBody = json_decode($dResponse->getBody()->getContents());
        $id = $responseBody->id;

        $payment = new Payment();
        $payment->paypal_id = $ppResponse->result->id;
        $payment->discord_id = $id;
        $payment->full_name = 'Unknown';
        $payment->email = 'Unknown';
        $payment->ip = request()->ip();
        $payment->amount = $ppResponse->result->purchase_units[0]->amount->value;
        $payment->currency = $ppResponse->result->purchase_units[0]->amount->currency_code;

        $payment->save();

        TempApplication::where('discord_id', $id)->orderBy('created_at', 'desc')->take(1)->update(['state' => 666]);

        return redirect('/');
    }
}
