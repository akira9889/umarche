<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendThanksMail;
use App\Mail\Testmail;
use Illuminate\Support\Facades\Mail;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('item');
            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('products.id', $id)->exists();
                if (!$itemId) {
                    abort(404); //404表示
                }
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $categories = PrimaryCategory::with('secondary')->get();

        //同期的に送信
        // Mail::to('test@example.com')->send(new Testmail());

        //非同期に送信
        // SendThanksMail::dispatch();

        $products = Product::availableItems()
        ->selectCategory($request->category ?? '0')
        ->serachKeyword($request->keyword)
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');

        return view('user.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if ($quantity > 9) {
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}
