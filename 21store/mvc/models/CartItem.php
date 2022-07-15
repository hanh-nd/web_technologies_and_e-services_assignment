
<?php require_once ROOT . DS . 'services' . DS . "ProductService.php";

class CartItem {
    private $id;                  
    private $cartId;            
    private $productId;              
    private $quantity;           
    private $createdAt;              

    public function __construct($cartItem) {
        $this->id = $cartItem->id;
        $this->cartId = $cartItem->cartSessionId;
        $this->productId = $cartItem->productId;
        $this->quantity = $cartItem->quantity;
        $this->createdAt = $cartItem->createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getCartId() {
        return $this->cartId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    public function getProduct() {
        $productService = new ProductService();
        return $productService->getProduct($this->productId);
    }
}
?>