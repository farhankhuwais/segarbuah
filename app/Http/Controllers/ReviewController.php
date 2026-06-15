<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|max:1000',
        ]);

        $hasPurchased = Order::where('user_id', auth()->id())
            ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
            ->whereIn('status', ['delivered', 'shipped', 'processing'])
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products you have purchased.');
        }

        $existing = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->update($data);
            $msg = 'Review updated.';
        } else {
            Review::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                ...$data,
            ]);
            $msg = 'Review submitted.';
        }

        return back()->with('success', $msg);
    }

    public function destroy(Product $product, Review $review)
    {
        if ($review->user_id !== auth()->id()) abort(404);
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
