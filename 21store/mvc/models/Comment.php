<?php
require_once ROOT . DS . 'services' . DS . 'UserService.php';

class Comment {
    private $id;                    // int
    private $productId;             // string
    private $userId;              // string
    private $content;              // string
    private $createdAt;             // string
    private $rate;             // int

    public function __construct($comment) {
        $this->id = $comment->id;
        $this->productId = $comment->productId;
        $this->userId = $comment->userId;
        $this->content = $comment->content;
        $this->rate = $comment->rate;
        $this->createdAt = $comment->createdAt;
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
    public function getNameUser() {
        $userService = new UserService();
        $user = $userService->getUser($this->userId);
        return $user->getFullname();
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    public function getContent() {
        return $this->content;
    }
}
?>