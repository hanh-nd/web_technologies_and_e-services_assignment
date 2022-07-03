
<?php

class Bill {
    private $id;                  
    private $userId;            
    private $totalAmount;              
    private $status;         // Chờ xác nhận Đang giao Đã mua      
    private $createdAt;              

    public function __construct($bill) {
        $this->id = $bill->id;
        $this->userId = $bill->userId;
        $this->createdAt = $bill->createdAt;
        $this->totalAmount = $bill->totalAmount;
        $this->status = $bill->status;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function getFormattedTotalAmount() {
        return number_format($this->totalAmount, 0, '', ',') . " VND";
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    
}
?>