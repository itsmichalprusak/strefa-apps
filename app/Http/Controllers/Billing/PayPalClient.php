<?php

namespace App\Http\Controllers\Billing;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use ProductionEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "AYhTIZjGbPJEZgZxizRKgnm7_YKVgoWdaW_O97InWOowEdb0XFtN4DOLXayWiN128lSz-EEjQftH4Ehr";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EH1udxVy2BFYcqaR43_-CvUjaXcvMZsu4iyl7KXbCbiv0AR0L860YzKC-9Uq_cerAt5necF2B2Ov4aOJ";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}