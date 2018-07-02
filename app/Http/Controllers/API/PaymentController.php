<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_gLATv8KZlyjRXxhTP8qQjg3P");

        $amount = str_replace('.','', $request->amount);
        $amount .= '0';

        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'source' => $request->token,
            'receipt_email' => $request->receipt_email,
        ]);

        return response()->json($charge);
    }
}
