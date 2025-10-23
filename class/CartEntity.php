<?php

require_once 'class/ProductEntity.php';

class Cart 
{
    private $products = [];

    //fonction pour ajouter un produit dans un panier, le produit est ajouter dans un tableau de produits
    public function addProduct(Product $product) 
    {
        $this->products[] = $product;
        $this->addExceptionOnProduct($product);
    }

    //fonction pour obtenir le total du panier
    public function getTotal() 
    {
        $total = 0;
        foreach ($this->products as $product) 
        {
            $total += $product->getPrice();
        }
        return $total;
    }

    //fonction pour supprimer un produit du panier
    public function deleteProduct(Product $product)
    {
        foreach ($this->products as $index => $p) 
        {
        if ($p->getName() === $product->getName() && $p->getPrice() === $product->getPrice()) 
            {
            unset($this->products[$index]);

            $this->products = array_values($this->products);
            break;
            }
        }
    }

    public function applyDiscount(float $discountPercentage) 
    {
        foreach ($this->products as $product) 
        {
            $newPrice = $product->getPrice() * (1 - $discountPercentage / 100);
            $product->setPrice($newPrice);
        }
    }

    public function addExceptionOnProduct(Product $product) 
    {
        if ($product->getPrice() < 0) 
        {
            throw new InvalidPriceError("Le prix du produit ne peut pas être négatif.");
        }
    }

    public function saveCartOnFile($filename) 
    {
        $data = [];
        foreach ($this->products as $product) 
        {
            $data[] = [
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];
        }
        file_put_contents($filename, json_encode($data));
    }
}