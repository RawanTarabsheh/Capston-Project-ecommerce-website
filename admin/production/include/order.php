<?php
class Order{
  
    // database connection and table name
    private $conn;
    private $table_name = "orders";
  
    // object properties
    public $id;
    public $o_date;
    public $customer_id ;
    public $product_id;
    public $qty;
    public $payment_method;
    public $total;
    public $notes;
  
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
                    order_date";  
  
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
                order_date ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}

    // create product
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    order_date=:o_date,customer_id=:customer_id,product_id=: product_id,qty=:qty,
                    payment_method=:pay,total=:total,notes=:notes ";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->o_date         = htmlspecialchars(strip_tags($this->o_date));
        $this->customer_id    = htmlspecialchars(strip_tags($this->customer_id));
        $this->product_id     = htmlspecialchars(strip_tags($this->product_id));
        $this->qty            = htmlspecialchars(strip_tags($this->qty));
        $this->payment_method = htmlspecialchars(strip_tags($this->payment_method));
        $this->total          = htmlspecialchars(strip_tags($this->total));
        $this->notes          = htmlspecialchars(strip_tags($this->notes));
        // bind values 
        $stmt->bindParam(":o_date", $this->o_date);
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":qty", $this->qty);
        $stmt->bindParam(":payment_method", $this->payment_method);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":notes", $this->notes);
       
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

public function countAll(){
  
    $query = "SELECT order_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

}
?>