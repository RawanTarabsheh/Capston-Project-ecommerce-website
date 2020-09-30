<?php
class Vendor_message{
  
    // database connection and table name
    private $conn;
    private $table_name = "vendor_message";
  
    // object properties
    public $id;
    public $vendor_id;
    public $date;
    public $title;
    public $message;
  
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
                    date";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT vendors.vendor_image as image,vendors.vendor_name as vendor_name,vendor_message.message as message,vendor_message.date as v_date,vendor_message.title as title FROM " . $this->table_name . " INNER JOIN vendors ON vendor_message.vendor_id = vendors.vendor_id WHERE vendor_message.vendor_id = ?
            ORDER BY
                date ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
    // used to read message  by its vendor ID
function read_vendor_message(){
      
    $query = "SELECT vendors.vendor_image as image,vendors.vendor_name as vendor_name,vendor_message.message as message,vendor_message.date as v_date,vendor_message.title as title  FROM " . $this->table_name . " INNER JOIN vendors ON vendor_message.vendor_id = vendors.vendor_id WHERE vendor_message.vendor_id = ? ";
    $stmt = $this->conn->prepare( $query );
  
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
    return $stmt;
}
  
    // create message
    function create(){
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    vendor_id=:vendor_id, message=:message,date=:date,title=:title";
        $stmt            = $this->conn->prepare($query);
        // posted values
        $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
        $this->message   = htmlspecialchars(strip_tags($this->message));
        $this->date      = htmlspecialchars(strip_tags($this->date));
        $this->title      = htmlspecialchars(strip_tags($this->title));

        // bind values 
        $stmt->bindParam(":vendor_id", $this->vendor_id);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":title", $this->title);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

     // update message
    function update(){
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                vendor_id=:vendor_id, message=:message,date=:date,title=:title  
                WHERE  id  = :id";
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
        $this->message   = htmlspecialchars(strip_tags($this->message));
        $this->date      = htmlspecialchars(strip_tags($this->date));
        $this->title     = htmlspecialchars(strip_tags($this->title));
  		$this->id        = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam (":vendor_id", $this->vendor_id);
        $stmt->bindParam (":message", $this->message);
        $stmt->bindParam (":date", $this->date);
        $stmt->bindParam(":title", $this->title);
  		$stmt->bindParam (":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    }
// delete the message
function delete(){
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";    
    $stmt  = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging messag
public function countAll(){
    $query = "SELECT id FROM " . $this->table_name . "";
    $stmt  = $this->conn->prepare( $query );
    $stmt->execute();
    $num   = $stmt->rowCount();
    return $num;
}

// used for messag vendor
public function countAll_v(){
    $query = "SELECT id FROM " . $this->table_name . " WHERE vendor_id=?";
    $stmt  = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
    $num   = $stmt->rowCount();
    return $num;
}
}
?>