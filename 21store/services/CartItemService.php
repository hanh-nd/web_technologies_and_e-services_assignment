<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'CartItem.php';

class CartItemService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'cart_items';
    }

    public function insert($cartSessionId, $productId, $quantity) {
        $query = "SELECT * FROM cart_items WHERE cart_session_id = '$cartSessionId' AND product_id = '$productId' ";
        parent::setQuery($query);
        $existedCartItemRow =parent::executeQuery();
        if (isset($existedCartItemRow) && !empty($existedCartItemRow)) {
            $existedCartItem =  $this->fromObject($existedCartItemRow[0]);
            $oldQuantity = $existedCartItem->getQuantity();
            $newQuantity = $oldQuantity + $quantity;
            $query = "UPDATE cart_items SET quantity = '$newQuantity' WHERE product_id = '$productId' AND cart_session_id = '$cartSessionId' ";
        }
        else 
        $query = "INSERT INTO cart_items (cart_session_id, product_id, quantity) VALUES ('$cartSessionId', '$productId', '$quantity')";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function update($cartItemId, $isIncrease) {
        $query = "SELECT * FROM cart_items WHERE id = '$cartItemId' ";
        parent::setQuery($query);
        $existedCartItem = parent::executeQuery();
        $existedCartItem = $this->fromObject($existedCartItem[0]);
        $currentQuantity = $existedCartItem->getQuantity();
        if ($isIncrease == true){
            $currentQuantity = $currentQuantity + 1;
        }
        else {
            $currentQuantity = $currentQuantity - 1;
        }
        if ($currentQuantity>0){
            $query = "UPDATE cart_items SET quantity = '$currentQuantity' WHERE id = '$cartItemId' ";
        }
        else {
            $query = "DELETE FROM cart_items WHERE id = '$cartItemId'";
        }
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function updateQuantity($cartItemId, $quantity) {
        $query = "UPDATE cart_items SET quantity = '$quantity' WHERE id = '$cartItemId' ";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function delete($cartItemId) {
        $query = "DELETE FROM cartItem WHERE id = '$cartItemId' ";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function fromObject($object) {
        return new CartItem($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new CartItem($object));
        }
        return $result;
    }

    public function getCartItem($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }
    public function getAllCartItemsFormCart($userId) {
        $query = "SELECT * FROM cart_items WHERE cart_session_id = (SELECT id FROM cart_sessions WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1)";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }


}
?>