<?php
class ProductView {
    public function showDetails($product) {
        echo "Product Details:\n";
        echo "- ID: {$product->getId()}\n";
        echo "- Name: {$product->getName()}\n";
        echo "- Price: {$product->getFormattedPrice()}\n";
    }
}
