<?php
class Admin{
  
    // database connection and table name
    private $conn;
    private $table_name = "admin";
  
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $image;
  
    public function __construct($db){
        $this->conn = $db;
    }
  function login(){
    $query = "SELECT * FROM " . $this->table_name .
              " WHERE admin_email = :email AND  admin_password=:password";
     $stmt = $this->conn->prepare( $query );
     $stmt->bindParam(":email", $this->email);
     $stmt->bindParam(":password", $this->password);
     $stmt->execute();
     $row   = $stmt->fetch(PDO::FETCH_ASSOC);
     $count = $stmt->rowCount();
     if($count==1){
    $this->id       = $row['admin_id'];
    $this->name     = $row['admin_name'];
    $this->email    = $row['admin_email'];
    $this->password = $row['admin_password'];
    $this->image    = $row['admin_image'];
    return $row;}
   
  }
   function check_email(){
    $query = "SELECT * FROM " . $this->table_name .
              " WHERE admin_email = :email";
     $stmt = $this->conn->prepare( $query );
     $stmt->bindParam(":email", $this->email);
        $stmt->execute();
     $row   = $stmt->fetch(PDO::FETCH_ASSOC);
     $count = $stmt->rowCount();
     if($count==1)   
       return true;
    else
       return false;
   
  }
    function read(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    admin_name";  
  
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
                admin_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read admin  by its ID
function read_admin_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE admin_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name     = $row['admin_name'];
    $this->email    = $row['admin_email'];
    $this->password = $row['admin_password'];
    $this->image    = $row['admin_image'];
    return $row;
}
  
    // create admin
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    admin_name=:name,admin_email=:email, admin_password=:password,admin_image=:image";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image    = htmlspecialchars(strip_tags($this->image));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":image", $this->image);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // create admin
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                    admin_name=:name,admin_email=:email, admin_password=:password,admin_image=:image
                WHERE
                admin_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image    = htmlspecialchars(strip_tags($this->image));
  		$this->id       = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":image", $this->image);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the admin
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE admin_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging admin
public function countAll(){
  
    $query = "SELECT admin_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>