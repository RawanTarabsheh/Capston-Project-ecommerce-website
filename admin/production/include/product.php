<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "products";
  
    // object properties
    public $id;
    public $name;
    public $desc;
    public $price;
    public $color;
    public $size;
    public $image;
    public $offer;
    public $sub_cat_id;
    public $state;
    public $date;
    public $vendor_id;
    public $feature;
    public $num_product;
    public $other_image;

  
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
                    product_name";  

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
function read_banner(){
         $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                    WHERE state=1 AND features=1
                ORDER BY date
                 LIMIT 0,10";  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
}
     function read_feature(){
        //select all data
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                    WHERE features=? and state=1
                ORDER BY
                    date
                    ";  
  
        $stmt = $this->conn->prepare( $query );
         $stmt->bindParam(1, $this->feature);
        $stmt->execute();
  
        return $stmt;
    }
function readAll($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                product_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
function readAll_admin_pending($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
                WHERE state=0
            ORDER BY
                product_name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}
public function countAll_padmin(){
  
    $query = "SELECT product_id FROM " . $this->table_name . " WHERE state=0";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}

function readAll_vid($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE vendor_id=? and state=1 
            ORDER BY
                product_name ASC
              
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
  
    return $stmt;
}
public function countAll_vid(){
  
    $query = "SELECT product_id FROM " . $this->table_name . " WHERE state=1 and vendor_id=?";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
function readAll_vid_prnding($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE vendor_id=? AND state=0
            ORDER BY
                product_name ASC
              
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
  
    return $stmt;
}
public function countAll_p(){
  
    $query = "SELECT product_id FROM " . $this->table_name . " WHERE state=0 and vendor_id=?";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->vendor_id);
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
function readAll_subcat_id_pag ($from_record_num, $records_per_page){
  
    $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE sub_cat_id=? AND state=1
            ORDER BY
                product_name ASC
              
            LIMIT
                {$from_record_num}, {$records_per_page}";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->sub_cat_id);
    $stmt->execute();
  
    return $stmt;
}
function readAll_subcat_id(){
  
    $query = "SELECT
                * 
            FROM
                " . $this->table_name . "
            WHERE sub_cat_id=? AND state=1
            ORDER BY
                product_name ASC
              ";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->sub_cat_id);
    $stmt->execute();
  
    return $stmt;
}
function readAll_subcat_id_count(){
  
    $query = "SELECT
                count(product_id) as count
            FROM
                " . $this->table_name . "
            WHERE sub_cat_id=? AND state=1
            ORDER BY
                product_name ASC
              ";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->sub_cat_id);
    $stmt->execute();
  
    return $stmt;
}
function read_cat_name()
{

 $query = "SELECT category_name FROM  category INNER JOIN" 
 . $this->table_name . "ON category.category_id= products.cat_id
  WHERE products.product_id = ? limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['category_name'];
    
}
function read_category_sub ()
{
    $query="SELECT category_name,sub_cat_name,sub_cat_id FROM 
    category INNER JOIN sub_category ON
    category.category_id = sub_category.category_id 
    ORDER BY category_name ASC
     ";
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
   return $stmt;
}
// used to read product  by its ID
function read_product_id(){
      
    $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = ?  limit 0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->name       = $row['product_name'];
    $this->desc       = $row['product_desc'];
    $this->price      = $row['product_price'];
    $this->color      = $row['product_color'];
    $this->size       = $row['product_size'];
    $this->image      = $row['product_image'];
    $this->other_image= $row['other_images'];
    $this->offer      = $row['product_offer'];
    $this->sub_cat_id = $row['sub_cat_id'];
    $this->state      = $row['state'];
    $this->date       = $row['date'];
    $this->vendor_id  = $row['vendor_id'];
    $this->feature    = $row['features'];
    $this->num_product= $row['num_of_products'];
    return $row;

}
  
    // create product
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    product_name=:name,product_desc=:desc, product_price=:price,product_color=:color,
                    product_size=:size,product_image=:image,product_offer=:offer,sub_cat_id=:sub_cat_id,
                    state=:state,date=:date,vendor_id=:vendor_id,features=:feature,num_of_products=:num_product
                    ";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name      = htmlspecialchars(strip_tags($this->name));
        $this->desc      = htmlspecialchars(strip_tags($this->desc));
        $this->price     = htmlspecialchars(strip_tags($this->price));
        $this->color     = htmlspecialchars(strip_tags($this->color));
        $this->size      = htmlspecialchars(strip_tags($this->size));
        $this->image     = htmlspecialchars(strip_tags($this->image));
        $this->offer     = htmlspecialchars(strip_tags($this->offer));
        $this->sub_cat_id= htmlspecialchars(strip_tags($this->sub_cat_id));
        $this->state     = htmlspecialchars(strip_tags($this->state));
        $this->date      = htmlspecialchars(strip_tags($this->date));
        $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
        $this->feature   = htmlspecialchars(strip_tags($this->feature));
        $this->num_product = htmlspecialchars(strip_tags($this->num_product));

  
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":desc", $this->desc);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":offer", $this->offer);
        $stmt->bindParam(":sub_cat_id", $this->sub_cat_id);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":vendor_id", $this->vendor_id);
        $stmt->bindParam(":feature", $this->feature);
        $stmt->bindParam(":num_product", $this->num_product);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

     // update product
    function update(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                  product_name=:name,product_desc=:desc, product_price=:price,product_color=:color,
                    product_size=:size,product_image=:image,product_offer=:offer,sub_cat_id=:sub_cat_id,
                    state=:state,date=:date,vendor_id=:vendor_id,features=:feature,num_of_products=:num_product
                WHERE
                product_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->name      = htmlspecialchars(strip_tags($this->name));
        $this->desc      = htmlspecialchars(strip_tags($this->desc));
        $this->price     = htmlspecialchars(strip_tags($this->price));
        $this->color     = htmlspecialchars(strip_tags($this->color));
        $this->size      = htmlspecialchars(strip_tags($this->size));
        $this->image     = htmlspecialchars(strip_tags($this->image));
        $this->offer     = htmlspecialchars(strip_tags($this->offer));
        $this->sub_cat_id= htmlspecialchars(strip_tags($this->sub_cat_id));
        $this->state     = htmlspecialchars(strip_tags($this->state));
        $this->date      = htmlspecialchars(strip_tags($this->date));
        $this->vendor_id = htmlspecialchars(strip_tags($this->vendor_id));
        $this->feature   = htmlspecialchars(strip_tags($this->feature));
        $this->num_product = htmlspecialchars(strip_tags($this->num_product));
  		$this->id        = htmlspecialchars(strip_tags($this->id));
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":desc", $this->desc);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":size", $this->size);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":offer", $this->offer);
        $stmt->bindParam(":sub_cat_id", $this->sub_cat_id);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":vendor_id", $this->vendor_id);
        $stmt->bindParam(":feature", $this->feature);
        $stmt->bindParam(":num_product", $this->num_product);
  		$stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
     // create product
    function update_qty(){
  
        //write query
        $query = "UPDATE 
                    " . $this->table_name . "
                SET
                  num_of_products=:num_product
                WHERE
                product_id = :id";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        
        $this->num_product = htmlspecialchars(strip_tags($this->num_product));
        $this->id        = htmlspecialchars(strip_tags($this->id));
        // bind values 
       
        $stmt->bindParam(":num_product", $this->num_product);
        $stmt->bindParam(":id", $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
// delete the product
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE product_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// delete the product
function deletepro_vendor(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE vendor_id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// used for paging products
public function countAll(){
  
    $query = "SELECT product_id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
public function countAll_active(){
  
    $query = "SELECT product_id FROM " . $this->table_name . " WHERE state=1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
function search($pattern){
  
    $query = "SELECT
                * 
            FROM
                " . $this->table_name . "
            WHERE product_name LIKE '$pattern%' AND state=1
              ";
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->sub_cat_id);
    $stmt->execute();
  
    return $stmt;
}

}
?>