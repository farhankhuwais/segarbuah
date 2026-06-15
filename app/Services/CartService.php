<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getItems(): array
    {
        return session($this->sessionKey, []);
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $items = $this->getItems();
        $id = $product->id;

        if (isset($items[$id])) {
            $items[$id]['quantity'] += $quantity;
        } else {
            $unsplash = ['photo-1610348725531-843dff563e2c', 'photo-1567306226416-28f0efdc88ce', 'photo-1507003211169-0a1dd7228f2d', 'photo-1553279768-865429fa0078'];
            $items[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'unit' => $product->unit,
                'weight' => (float) $product->weight_in_grams,
                'image' => $unsplash[$product->id % 4],
                'stock' => $product->stock,
            ];
        }

        session([$this->sessionKey => $items]);
    }

    public function update(int $productId, int $quantity): void
    {
        $items = $this->getItems();
        if (isset($items[$productId])) {
            $items[$productId]['quantity'] = max(1, min($quantity, $items[$productId]['stock']));
            session([$this->sessionKey => $items]);
        }
    }

    public function remove(int $productId): void
    {
        $items = $this->getItems();
        unset($items[$productId]);
        session([$this->sessionKey => $items]);
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getCount(): int
    {
        $count = 0;
        foreach ($this->getItems() as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    public function clear(): void
    {
        session([$this->sessionKey => []]);
    }

    public function hasItem(int $productId): bool
    {
        return isset($this->getItems()[$productId]);
    }
}