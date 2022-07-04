<?php

class Brand {
    private $id;                    // int
    private $brandName;             // string
    private $imageUrl;              // string
    private $createdAt;             // string

    public function __construct($brand) {
        $this->id = $brand->id;
        $this->brandName = $brand->brandName;
        $this->imageUrl = $brand->imageUrl;
        $this->createdAt = $brand->createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getBrandName() {
        return $this->brandName;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}
?>