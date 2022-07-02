<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';

class ProductService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'products';
    }

    public function insert($productName, $productDescription, $price, $imageUrl, $size, $color, $material, $brandId, $productType) {
        $query = "INSERT INTO products(product_name, product_description, price, image_url, size, color, material, brand_id, product_type) VALUES (`$productName`, `$productDescription`, `$price`, `$imageUrl`, `$size`, `$color`, `$material`, `$brandId`, `$productType`)";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function fromObject($object) {
        return new Product($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Product($object));
        }
        return $result;
    }

    public function getProduct($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getAllProducts() {
        $objArr = $this->selectAll();
        return $this->fromObjectArray($objArr);
    }

    public function getNewArrivalProducts() {
        $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 8";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function getPaginatedProducts($page, $pageSize, $searchQuery, $sortBy, $orderBy) {
        if ($page < 1) {
            $page = 1;
        }

        if ($pageSize < 0) {
            $pageSize = 0;
        }

        $offset = ($page - 1)  * $pageSize;
        $limit = $pageSize;
        $query = "SELECT * FROM products WHERE product_name LIKE '%{$searchQuery}%' ORDER BY $sortBy $orderBy LIMIT $limit OFFSET $offset";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function getTotalProducts($searchQuery) {
        return parent::getTotalRowsWithKeyword('product_name', $searchQuery);
    }
}
?>