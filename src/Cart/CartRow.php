<?php

namespace App\Cart;

class CartRow
{
    private int $productId;

    private int $quantity;

    public function __construct(int $productId, int $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function add(int $quantity): void
    {
        $this->quantity += $quantity;
    }

    public function remove(int $quantity): void
    {
        if ($quantity > $this->quantity) {
            throw new \InvalidArgumentException('Quantity to remove is greater than quantity in cart');
        }

        $this->quantity -= $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}