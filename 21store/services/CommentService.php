<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Comment.php';

class CommentService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'comments';
    }

    public function insert($productId, $userId, $rate, $content) {
        $query = "INSERT INTO comments (product_id, user_id, rate, content) VALUES ('$productId', '$userId', '$rate', '$content')";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function fromObject($object) {
        return new Comment($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Comment($object));
        }
        return $result;
    }

    public function getComment($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getAllCommentFormProduct($productId) {
        $query = "SELECT * FROM comments WHERE product_id = " . $productId;
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }
}
?>