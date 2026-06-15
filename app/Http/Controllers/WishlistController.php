<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $products = auth()->user()->wishlist()
            ->with('category')
            ->paginate(12);

        return view('pages.wishlist', compact('products'));
    }

    public function toggle(Product $product)
    {
        $user = auth()->user();
        $exists = $user->wishlist()->where('product_id', $product->id)->exists();

        if ($exists) {
            $user->wishlist()->detach($product->id);
            $added = false;
        } else {
            $user->wishlist()->attach($product->id);
            $added = true;
        }

        if (request()->wantsJson()) {
            return response()->json(['added' => $added]);
        }

        return redirect()->back()->with('success', $added ? 'Added to wishlist.' : 'Removed from wishlist.');
    }
}
