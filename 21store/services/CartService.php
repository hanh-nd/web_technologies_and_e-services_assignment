<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Cart.php';
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Bill.php';
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'CartItem.php';
require_once ROOT . DS . 'services' . DS . "ProductService.php";


class CartService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'cart_sessions';
    }

    public function insert($userId) {
        $query = "INSERT INTO cart_sessions (user_id) VALUES ('$userId')";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function getCartSessionByUserId($userId){
        $query = "SELECT * FROM cart_sessions WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1 ";
        parent::setQuery($query);
        $res = parent::executeQuery();

        if (empty($res)){
            $this->insert($userId);
            $query = "SELECT * FROM cart_sessions WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1 ";
            parent::setQuery($query);
            $res = parent::executeQuery();
        }
        return $this->fromObject($res[0]);
    }

    public function fromObject($object) {
        return new Cart($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Cart($object));
        }
        return $result;
    }

    public function fromCartItemObject($object) {
        return new CartItem($object);
    }

    public function fromCartItemObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new CartItem($object));
        }
        return $result;
    }
    public function fromBillObject($object) {
        return new Bill($object);
    }

    public function getCart($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function addOrder($items, $billId){
        foreach ($items as $item){
            $productId = $item->getProductId();
            $quantity = $item->getQuantity();
            $productService = new ProductService();
            $productService->updateQuantity($productId, $quantity);
            $query = "INSERT INTO order_items(bill_id, product_id, quantity) VALUES ('$billId', '$productId', '$quantity')";
            parent::setQuery($query);
            parent::executeQuery();           
        }
    }

    public function createBill($userId){
        $query = "INSERT INTO bills (user_id) VALUES ('$userId') ";
        parent::setQuery($query);
        parent::executeQuery();
        $query = "SELECT * FROM bills WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1";
        parent::setQuery($query);
        $res = parent::executeQuery();  
        $res = $this->fromBillObject($res[0])->getId();  
        return $res;    
    }

    public function buy($userId) {
        $cartSessionId = $this -> getCartSessionByUserId($userId)->getId();
        $query = "SELECT * FROM cart_items WHERE cart_session_id = '$cartSessionId' ";
        parent::setQuery($query);
        $items = parent::executeQuery();
        $items = $this->fromCartItemObjectArray($items);
        $billId = $this->createbill($userId);
        $this->addOrder($items, $billId);
        $this->insert($userId);
    }

}
?>