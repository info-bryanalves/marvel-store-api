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
    public function registerPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey("sk_test_gLATv8KZlyjRXxhTP8qQjg3P");

        $charge = \Stripe\Charge::create([
            'amount' => $request->total,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'receipt_email' => 'jenny.rosen@example.com',
        ]);
    }
}
