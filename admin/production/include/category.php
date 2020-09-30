<?php
class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "category";
  
    // object properties
    public $id;
    public $name;
    public $image;
  
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
                    category_name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
    function read_menu(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    category_id 
                    LIMIT 0,3";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
     function count_items(){
        $query ="SELECT COUNT(sub_cat_id) as num FROM sub_category WHERE category_id=?";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['num'];
    }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                category_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read category  by its ID
function read_category_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name     = $row['category_name'];
    $this->image    = $row['category_image'];
    return $row;
}
  
    // create category
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    category_name=:name,category_image=:image";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->image    = htmlspecialchars(strip_tags($this->image));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
  
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
                    category_name=:name,category_image=:image
                WHERE
                category_id  = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->image    = htmlspecialchars(strip_tags($this->image));
  		$this->id       = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the category
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE category_id  = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging category
public function countAll(){
  
    $query = "SELECT category_id  FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>