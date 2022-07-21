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
        $query = "INSERT INTO products(product_name, product_description, price, image_url, size, color, material, brand_id, product_type)
            VALUES ('$productName', '$productDescription', '$price', '$imageUrl', '$size', '$color', '$material', '$brandId', '$productType')";
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
        parent::setQuery($query);
        parent::updateQuery();


        //delete product in order_items table
        $query = "delete from order_items
                  where product_id = " . $id;
        parent::setQuery($query);
        parent::updateQuery();

        //delete product in cart_items table
        $query = "delete from cart_items
                  where product_id = " . $id;
        parent::setQuery($query);
        parent::updateQuery();

        $query = "delete from products
        where id = " . $id;
        parent::setQuery($query);
        parent::updateQuery();

    }

    /**
     * The method update data to database
     * @param Product $product
     */
    public function update($id,$name,$des, $price, $image_url,
    $size, $color, $material, $brandId, $product_type, $quantity) {
        $query = "UPDATE products
                    SET product_name =  '$name',
                    product_description = '$des',
                    price = '$price',
                    image_url = '$image_url',
                    color = '$color',
                    size = '$size',
                    material = '$material',
                    brand_id = '$brandId',
                    product_type ='$product_type',
                    quantity ='$quantity'
                    WHERE id = '$id'";
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
          
    public function getPaginatedProducts($page, $pageSize, $filters = null, $sortBy = "created_at", $orderBy = "asc") {
        if (isset($filters)) {
            $searchQuery = $filters->searchQuery;
            $brandFilters = $filters->brandFilters;
        } else {
            $searchQuery = '';
            $brandFilters = array();
        }


        if ($page < 1) {
            $page = 1;
        }

        if ($pageSize < 0) {
            $pageSize = 0;
        }

        $offset = ($page - 1)  * $pageSize;
        $limit = $pageSize;
        $query = "SELECT * FROM products WHERE product_name LIKE '%{$searchQuery}%'";

        if (!empty($brandFilters)) {
            $query = $query . " AND brand_id IN (";
            foreach ($brandFilters as $id) {
                $query = $query . "'$id', ";
            }
            $query = substr($query, 0, -2) . ")";
        }

        $query = $query . " ORDER BY $sortBy $orderBy LIMIT $limit OFFSET $offset";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function getTotalProducts($filters) {
        $searchQuery = $filters->searchQuery;
        $brandFilters = $filters->brandFilters;
        $query = "SELECT COUNT(*) FROM `$this->table` WHERE product_name LIKE '%{$searchQuery}%'";

        if (!empty($brandFilters)) {
            $query = $query . " AND brand_id IN (";
            foreach ($brandFilters as $id) {
                $query = $query . "'$id', ";
            }
            $query = substr($query, 0, -2) . ")";
        }

        return parent::getTotalRows($query);
    }

    public function updateQuantity($productId, $quantity){
        $query = "SELECT * FROM products WHERE id = '$productId' ";
        parent::setQuery($query);
        $res = parent::executeQuery();
        $res = $this->fromObjectArray($res);
        $currentQuantity = $res[0]->getQuantity() - $quantity;
        echo $productId;
        echo $quantity;
        $query = "UPDATE products SET quantity = $currentQuantity WHERE id = $productId";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function deleteAll() {
        $productList = $this->getPaginatedProducts(1, 1000);

        foreach ($productList as $product) {
            $this->delete($product->getId());
        }
    }
}
?>