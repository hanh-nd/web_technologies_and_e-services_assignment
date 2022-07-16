<?php
	require_once ROOT . DS . 'services' . DS . 'CommentService.php';
    require_once ROOT . DS . 'services' . DS .'BrandService.php';


class Product {
    private $id;                    // int
    private $productName;           // string
    private $productDescription;    // string
    private $price;                 // int
    private $imageUrl;              // string
    private $size;                  // string
    private $color;                 // string
    private $material;              // string
    private $brandId;               // string
    private $productType;           // string
    private $rate;                  // int
    private $quantity;               // int
    private $createdAt;             // string

    public function __construct($product) {
        $this->id = $product->id;
        $this->productName = $product->productName;
        $this->productDescription = $product->productDescription;
        $this->price = $product->price;
        $this->imageUrl = $product->imageUrl;
        $this->size = $product->size;
        $this->color = $product->color;
        $this->material = $product->material;
        $this->brandId = $product->brandId;
        $this->productType = $product->productType;
        $this->rate = $product->rate;
        $this->quantity = $product->quantity;
        $this->createdAt = $product->createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getProductDescription() {
        return $this->productDescription;
    }

    public function getPrice() {
        return $this->price;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getFormattedPrice() {
        return number_format($this->price, 0, '', ',') . " VND";
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getSize() {
        return $this->size;
    }

    public function getColor() {
        return $this->color;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function getBrandId() {
        return $this->brandId;
    }

    public function getBrandName() {
        $brandService = new BrandService();
        $brand = $brandService->getBrand($this->brandId);
        return $brand->getBrandName();
    }

    public function getProductType() {
        return $this->productType;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    public function getAverageRate() {
        $commentService = new CommentService();
        $totalComment = $commentService->getAllCommentFormProduct($this->id);
        $count = 0;
        $sum = 0;
        foreach ($totalComment as $comment){
            $count++;
            $sum += $comment->getRate();
        }
        if($count == 0)
            return 0;
        return round($sum / $count, 1);
    }
}
?>