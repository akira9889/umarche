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
        $sig_header = $request->hfeader('stripe-signature');

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

        //Stripe決済画面に遷移し、30分経っても決済がない場合、確保しておいた在庫を戻す
        if ($event->type == 'checkout.session.expired') {
            $session = $event->data->object;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            $line_items = $stripe->checkout->sessions->allLineItems($session->id, ['expand' => ['data.price.product']]);

            foreach ($line_items as $line_item) {
                $metadata = $line_item->price->product->metadata;
                $product_id = $metadata->product;
                $quantity = $line_item->quantity;

                Stock::create([
                    'product_id' => $product_id,
                    'type' => \Constant::PRODUCT_LIST['add'],
                    'quantity' => $quantity
                ]);
            }
        }

        return response()->json('ok', 200);
    }
}
