<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';

class BrandService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'brands';
    }

    public function insert($brand) {
        $query = "INSERT INTO brands(brand_name, image_url) VALUES (`" . $brand->getBrandName() . "`, `" . $brand->getImageUrl() . "`)";
        parent::setQuery($query);
        parent::executeQuery();
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
        $query = "SELECT * FROM brands ORDER BY created_at DESC LIMIT " . $limit;
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }
}
?>