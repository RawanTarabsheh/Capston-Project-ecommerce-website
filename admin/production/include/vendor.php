<?php
class Vendor{
  
    // database connection and table name
    private $conn;
    private $table_name = "vendors";
  
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $image;
    public $address;
    public $phone;
    public $active;
  
    public function __construct($db){
        $this->conn = $db;
    }
    function login(){
    $query = "SELECT * FROM " . $this->table_name .
              " WHERE vendor_email = :email AND  vendor_password=:password AND active=1";
     $stmt = $this->conn->prepare( $query );
     $stmt->bindParam(":email", $this->email);
     $stmt->bindParam(":password", $this->password); 
     $stmt->execute();
     $row   = $stmt->fetch(PDO::FETCH_ASSOC);
     $count = $stmt->rowCount();
     if($count==1){
    $this->id       = $row['vendor_id'];
    $this->name     = $row['vendor_name'];
    $this->email    = $row['vendor_email'];
    $this->password = $row['vendor_password'];
    $this->image    = $row['vendor_image'];
    $this->address  = $row['vendor_address'];
    $this->phone    = $row['vendor_phone'];
    $this->active   = $row['active'];
    return $row;
}
   
  }
   function check_email(){
    $query = "SELECT * FROM " . $this->table_name .
              " WHERE vendor_email = :email and active=1";
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
                    WHERE active=1
                ORDER BY
                        vendor_name";  
  
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
                    vendor_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
function readAll_p($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
                WHERE active=0
            ORDER BY
                    vendor_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read vendor  by its ID
function read_vendor_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE   vendor_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name     = $row['vendor_name'];
    $this->email    = $row['vendor_email'];
    $this->password = $row['vendor_password'];
    $this->image    = $row['vendor_image'];
    $this->address  = $row['vendor_address'];
    $this->phone    = $row['vendor_phone'];
    $this->active   = $row['active'];
    return $row;
}

  
    // create vendor
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    vendor_name=:name,vendor_email=:email, vendor_password=:password,vendor_image=:image,
                    vendor_address=:address,vendor_phone=:phone,active=:active";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image    = htmlspecialchars(strip_tags($this->image));
        $this->address  = htmlspecialchars(strip_tags($this->address));
        $this->phone    = htmlspecialchars(strip_tags($this->phone));
        $this->active   = htmlspecialchars(strip_tags($this->active));
  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":active", $this->active);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // create vendor
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                    vendor_name=:name,vendor_email=:email, vendor_password=:password,vendor_image=:image,
                    vendor_address=:address,vendor_phone=:phone,active=:active
                WHERE
                vendor_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->image    = htmlspecialchars(strip_tags($this->image));
        $this->address  = htmlspecialchars(strip_tags($this->address));
        $this->phone    = htmlspecialchars(strip_tags($this->phone));
        $this->active   = htmlspecialchars(strip_tags($this->active));
  		$this->id       = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":active", $this->active);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the vendor
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE vendor_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging vendor
public function countAll(){
  
    $query = "SELECT vendor_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
public function countAll_p(){
  
    $query = "SELECT vendor_id FROM " . $this->table_name . " WHERE active=0";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
}
?>