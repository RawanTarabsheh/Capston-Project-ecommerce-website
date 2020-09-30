<?php
class Sub_Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "sub_category";
  
    // object properties
    public $id;
    public $name;
    public $cat_id;
    public $feature;
  
    public function __construct($db){
        $this->conn = $db;
    }
    
    function read(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    sub_cat_name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                sub_cat_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
function readAll_cat($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
           WHERE category_id=?

            ORDER BY
                sub_cat_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->cat_id);
    $stmt->execute();
  
    return $stmt;
}
    // used to read sub category  by its ID
function read_sub_category_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE sub_cat_id = ? limit 0,1";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name     = $row['sub_cat_name'];
    $this->id     = $row['sub_cat_id'];
    $this->cat_id   = $row['category_id'];
    return $row;
}
    // used to read sub category  by its ID
function read_category_id(){
      
    //$query = "SELECT * FROM " . $this->table_name . " WHERE category_id = ? limit 0,1";
    $query="SELECT sub_category.sub_cat_id as sub_id ,sub_category.sub_cat_name as sub_name,category.category_name as cat_name FROM 
    category INNER JOIN ".  $this->table_name .
    " ON category.category_id=sub_category.category_id where sub_category.category_id=?";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->cat_id);
    $stmt->execute();
    //$row  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $stmt;

}
function read_prodct_for_subcategory()
{
    $query="SELECT  products.num_of_products as num_of_products,products.features as features,  products.product_name as pro_name ,products.product_id as pro_id ,products.product_price as pro_price,products.product_offer as offer, products.product_image as pro_image,sub_category.category_id as cat_id FROM ".$this->table_name ." INNER JOIN products ON sub_category.sub_cat_id=products.sub_cat_id WHERE sub_category.category_id=? AND products.state=1 ORDER BY products.date
                  ";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->cat_id);
    $stmt->execute();
    //$row  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $stmt;
}
function read_prodct_for_subcategoryall($from_record_num, $records_per_page){
    $query="SELECT  products.num_of_products as num_of_products,products.features as features,  products.product_name as pro_name ,products.product_id as pro_id ,products.product_price as pro_price,products.product_offer as offer, products.product_image as pro_image,sub_category.category_id as cat_id FROM ".$this->table_name ." INNER JOIN products ON sub_category.sub_cat_id=products.sub_cat_id WHERE sub_category.category_id=? AND products.state=1 ORDER BY products.date
                    LIMIT
                {$from_record_num}, {$records_per_page}";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->cat_id);
    $stmt->execute();
    //$row  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $stmt;
}
public function countAll_sub(){
  
     $query="SELECT  products.num_of_products as num_of_products,products.features as features,  products.product_name as pro_name ,products.product_id as pro_id ,products.product_price as pro_price,products.product_offer as offer, products.product_image as pro_image,sub_category.category_id as cat_id FROM ".$this->table_name ." INNER JOIN products ON sub_category.sub_cat_id=products.sub_cat_id WHERE sub_category.category_id=? AND products.state=1 ORDER BY products.date";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->cat_id);
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
function read_prodct_for_subcategory_f()
{
    $query="SELECT products.sub_cat_id as sub_id, products.num_of_products as num_of_products,products.product_name as pro_name ,products.product_id as pro_id ,products.product_price as pro_price,products.product_offer as offer, products.product_image as pro_image,sub_category.category_id as cat_id FROM ".$this->table_name ." INNER JOIN products ON sub_category.sub_cat_id=products.sub_cat_id WHERE sub_category.category_id=:cat_id and products.features=:feature AND products.state=1";

    $stmt = $this->conn->prepare( $query );
    // posted values
        $this->cat_id     = htmlspecialchars(strip_tags($this->cat_id));
        $this->feature    = htmlspecialchars(strip_tags($this->feature));
  
        // bind values 
        $stmt->bindParam(":cat_id", $this->cat_id);
        $stmt->bindParam(":feature", $this->feature);
        $stmt->execute();
    //$row  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $stmt;
}
  
    // create sub category
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sub_cat_name=:name,category_id=:cat_id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->cat_id    = htmlspecialchars(strip_tags($this->cat_id));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":cat_id", $this->cat_id);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // create category
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                    sub_cat_name=:name,category_id=:cat_id
                WHERE
                sub_cat_id  = :id";
  
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->cat_id   = htmlspecialchars(strip_tags($this->cat_id));
  		$this->id       = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":cat_id", $this->cat_id);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the category
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE sub_cat_id  = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
function delete_all(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE category_id  = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->cat_id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging category
public function countAll(){
  
    $query = "SELECT sub_cat_id  FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>