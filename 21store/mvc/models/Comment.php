<?php

class Comment {
    private $id;                    // int
    private $productId;             // string
    private $userId;              // string
    private $content;              // string
    private $createdAt;             // string
    private $rate;             // int

    public function __construct($comment) {
        $this->createdAt = $comment->createdAt;
        $this->productId = $comment->productId;
        $this->userId = $comment->userId;
        $this->content = $comment->content;
        $this->id = $comment->id;
        $this->rate = $comment->rate;
    }

    public function getId() {
        return $this->id;
    }

    public function getRate() {
        return $this->rate;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    public function getContent() {
        return $this->content;
    }
}
?>