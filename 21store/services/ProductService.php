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
     /**
     * The method support delete row in database
     * @param int $id
     */
    public function delete($id){
        


        //delete product in table comment
        $query = "delete from comments
                  where product_id = " . $id;
        parent::setQuerry($query);
        parent::updateQuery();


        //delete product in order_items table
        $query = "delete from order_items
                  where product_id = " . $id;
        parent::setQuerry($query);
        parent::updateQuery();

        //delete product in cart_items table
        $query = "delete from cart_items
                  where product_id = " . $id;
        parent::setQuerry($query);
        parent::updateQuery();

        $query = "delete from products
        where id = " . $id;
        parent::setQuerry($query);
        parent::updateQuery();

    }

    /**
     * The method update data to database
     * @param Product $product
     */
    public function update($product) {
        // update to products table
        //product_name, product_description, price, image_url, size, color, material, brand_id, product_type, quantity
        $query = "update products
                    set " .
                    "product_name = " . "'" . getProductName() . "' ," .
                    "product_description = " . "'" . $product->getProductDescription() . "' ," .
                    "price = " . $product->getPrice() . "," .
                    "image_url = " . $product->getImageUrl() . "," .
                    "color = " . "'" . $product->getColor() . "' ," .
                    "size = " . $product->getSize() . "," .
                    "material = " . "'" . $product->getMaterial() . "' ," .
                    "brand_id = " . "'" . $product->getBrandId() . "' ," .
                    "product_type = " . $product->getProductType() . "' ," .
                    "quantity = " . $product->getQuantity() . " " .
                    "where id = " . $product->getId() 
                    . "";
        parent::setQuerry($query);
        parent::updateQuery();
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

    public function getPaginatedProducts($page, $pageSize, $filters, $sortBy, $orderBy) {
        $searchQuery = $filters->searchQuery;
        
        if ($page < 1) {
            $page = 1;
        }

        if ($pageSize < 0) {
            $pageSize = 0;
        }

        $offset = ($page - 1)  * $pageSize;
        $limit = $pageSize;
        $query = "SELECT * FROM products WHERE product_name LIKE '%{$searchQuery}%'";
        if (isset($filters->brandId)) {
            $query = $query . " AND brand_id = $filters->brandId";
        }
        $query = $query . " ORDER BY $sortBy $orderBy LIMIT $limit OFFSET $offset";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function getTotalProducts($filters) {
        $searchQuery = $filters->searchQuery;
        $query = "SELECT COUNT(*) FROM `$this->table` WHERE product_name LIKE '%{$searchQuery}%'";
        if (isset($filters->brandId)) {
            $query = $query . " AND brand_id = $filters->brandId";
        }
        return parent::getTotalRows($query);
    }
}
?>