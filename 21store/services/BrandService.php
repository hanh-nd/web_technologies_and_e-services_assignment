<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';

class BrandService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'brands';
    }

    public function insert($brandName, $imageUrl) {
        $query = "INSERT INTO brands(brand_name, image_url) VALUES (`$brandName`, `$imageUrl`)";
        parent::setQuery($query);
        parent::executeQuery();
    }
      /**
     * The method support delete row in database
     * @param int $id
     */
    public function delete($id){

        
        //delete product in table comment
        $query = "update products set brand_id = null where brand_id = " .$id;
        parent::setQuerry($query);
        parent::updateQuery();
        
        $query = "delete from brands
                  where id = " . $id;
        parent::addQuerry($query);
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
        return new Brand($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Brand($object));
        }
        return $result;
    }

    public function getBrand($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getAllBrands($limit = 4) {
        $query = "SELECT * FROM brands ORDER BY created_at DESC LIMIT $limit";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }
}
?>