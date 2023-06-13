<?php

namespace App\Cart;

use App\Entity\Product;

class Cart
{
    /**
     * @var array<int, CartRow>
     */
    private array $rows = [];

    /**
     * @return array<int, CartRow>
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    public function add(Product $product, int $quantity): void
    {
        if (isset($this->rows[$product->getId()])) {
            $this->rows[$product->getId()]->add($quantity);

            return;
        }

        $this->rows[$product->getId()] = new CartRow($product->getId(), $quantity);
    }

    public function remove(Product $product, int $quantity): void
    {
        if (!isset($this->rows[$product->getId()])) {
            $this->rows[$product->getId()]->add($quantity);
                throw new \InvalidArgumentException('Product not found in cart');
        }

        $this->rows[$product->getId()]->remove($quantity);

        if ($this->rows[$product->getId()]->getQuantity() === 0) {
            unset($this->rows[$product->getId()]);
        }
    }
}