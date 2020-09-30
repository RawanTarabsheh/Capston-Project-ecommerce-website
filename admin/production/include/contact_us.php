<?php
class Contact_us{
  
    // database connection and table name
    private $conn;
    private $table_name = "contact_us";
  
    // object properties
    public $id;
    public $name;
    public $email;
    public $message;
    public $date;
    // for banner
    public  $state;
    public $product_id;
    public $title;
    public $desc;
    public function __construct($db){
        $this->conn = $db;
    }
    function read_banner(){
        //select all data
        $query = "SELECT * FROM banner Where state=1";  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }
  function create_banner(){
  
        //write query
        $query = "INSERT INTO banner
                SET
                    title=:title,body=:body, product_id=:product_id,state=:state";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->title     = htmlspecialchars(strip_tags($this->title));
        $this->desc    = htmlspecialchars(strip_tags($this->desc));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->state = htmlspecialchars(strip_tags($this->state));

  
        // bind values 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->desc);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":state", $this->state);

  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
    function read(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                ORDER BY
                    contact_us_name";  
  
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
                contact_us_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read admin  by its ID
function read_admin_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE contact_us_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name     = $row['contact_us_name'];
    $this->email    = $row['contact_us_email'];
    $this->message  = $row['contact_us_message'];
    $this->date     = $row['date'];

    return $row;
}
  
    // create admin
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    contact_us_name=:name,contact_us_email=:email, contact_us_message=:message,date=:date";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->date = htmlspecialchars(strip_tags($this->date));

  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":date", $this->date);

  
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
                 contact_us_name=:name,contact_us_email=:email, contact_us_message=:message,date=:date
                WHERE
                contact_us_id  = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name     = htmlspecialchars(strip_tags($this->name));
        $this->email    = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->date    = htmlspecialchars(strip_tags($this->date));
  		$this->id       = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":date", $this->date);

  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the admin
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE contact_us_id = ?";
      
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
  
    $query = "SELECT contact_us_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>