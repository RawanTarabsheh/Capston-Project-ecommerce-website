<?php
class Customer{
  
    // database connection and table name
    private $conn;
    private $table_name = "customers";
  
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $image;
    public $address;
    public $phone;
    public $last_login;       
    public $login_attempts;
  
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
                        customer_name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
     function login(){
    $query = "SELECT * FROM " . $this->table_name .
              " WHERE customer_email = :email AND  customer_password=:password";
     $stmt = $this->conn->prepare( $query );
     $stmt->bindParam(":email", $this->email);
     $stmt->bindParam(":password", $this->password);
     $stmt->execute();
     $row   = $stmt->fetch(PDO::FETCH_ASSOC);
     $count = $stmt->rowCount();
     if($count==1){
    $this->id            = $row['customer_id'];
     $this->name            = $row['customer_name'];
    $this->email           = $row['customer_email'];
    $this->password        = $row['customer_password'];
    $this->phone           = $row['customer_phone'];
    $this->address         = $row['customer_address'];
    $this->image           = $row['customer_image'];
    $this->last_login      = $row['last_login'];
    $this->login_attempts  = $row['login_attempts'];
    return $row;}
   
  }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                    customer_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read customer  by its ID
function read_customer_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE   customer_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name            = $row['customer_name'];
    $this->email           = $row['customer_email'];
    $this->password        = $row['customer_password'];
    $this->phone           = $row['customer_phone'];
    $this->address         = $row['customer_address'];
    $this->image           = $row['customer_image'];
    $this->last_login      = $row['last_login'];
    $this->login_attempts  = $row['login_attempts'];
    return $row;
}
  
    // create customer
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                  customer_name=:name,customer_email=:email, customer_password=:password,customer_phone=:phone,customer_address=:address,customer_image=:image,last_login=:last_login , login_attempts=:login_attempts";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name             = htmlspecialchars(strip_tags($this->name));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->password         = htmlspecialchars(strip_tags($this->password));
        $this->phone            = htmlspecialchars(strip_tags($this->phone));
        $this->address          = htmlspecialchars(strip_tags($this->address));
        $this->image            = htmlspecialchars(strip_tags($this->image));
        $this->last_login       = htmlspecialchars(strip_tags($this->last_login));
        $this->login_attempts   = htmlspecialchars(strip_tags($this->login_attempts));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":last_login", $this->last_login);
        $stmt->bindParam(":login_attempts", $this->login_attempts);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // create customer
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                  customer_name=:name,customer_email=:email, customer_password=:password,customer_phone=:phone,customer_address=:address,customer_image=:image,last_login=:last_login , login_attempts=:login_attempts
                WHERE
                customer_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name             = htmlspecialchars(strip_tags($this->name));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->password         = htmlspecialchars(strip_tags($this->password));
        $this->phone            = htmlspecialchars(strip_tags($this->phone));
        $this->address          = htmlspecialchars(strip_tags($this->address));
        $this->image            = htmlspecialchars(strip_tags($this->image));
        $this->last_login       = htmlspecialchars(strip_tags($this->last_login));
        $this->login_attempts   = htmlspecialchars(strip_tags($this->login_attempts));
  		$this->id               = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":last_login", $this->last_login);
        $stmt->bindParam(":login_attempts", $this->login_attempts);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the customer
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE   customer_id  = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging customer
public function countAll(){
  
    $query = "SELECT customer_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>