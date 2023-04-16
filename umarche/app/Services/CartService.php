<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];

        foreach ($items as $item) {
            //オーナー情報取得
            $p = Product::findOrFail($item->product_id);

            $owner = $p->shop->owner;

            // オーナー情報のキーを変更('ownerName', 'email')
            $ownerInfo = [
                'ownerName' => $owner->name,
                'email' => $owner->email
            ];

            // 商品情報の配列取得
            $product = Product::select('id', 'name', 'price')
                ->where('id', $item->product_id)
                ->get()->toArray()[0];

            // カートの商品数の配列取得
            $quantity = Cart::select('quantity')
                ->where('product_id', $item->product_id)
                ->get()->toArray()[0];

            // 配列の結合
            $product = array_merge($ownerInfo, $product, $quantity);

            //products配列に追加
            array_push($products, $product);
        }

        return $products;
    }
}
