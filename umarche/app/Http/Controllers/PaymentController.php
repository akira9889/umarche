<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function webhook(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $endpoint_secret = env('STRIPE_WEBHOOK');

        $payload = $request->getContent();
        $sig_header = $request->header('stripe-signature');

        $event = null;
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload.
            return response()->json('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid Signature.
            return response()->json('Invalid signature', 400);
        }

        //Stripe決済画面までいき、30分経っても決済がない場合、確保した在庫を戻す
        if ($event->type == 'checkout.session.expired') {
            $session = $event->data->object;
            logger()->debug($session);
            // Stock::create([
            //         'product_id' => 101,
            //         'type' => \Constant::PRODUCT_LIST['add'],
            //         'quantity' => 2,
            //     ]);

            // foreach ($items as $item) {
            //     // 在庫テーブルの在庫数を増やす
            //     Stock::create([
            //         'product_id' => $item->id,
            //         'type' => \Constant::PRODUCT_LIST['add'],
            //         'quantity' => $item->pivot->quantity,
            //     ]);
            // }
        }

        return response()->json('ok', 200);
    }
}
