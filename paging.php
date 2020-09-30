 <?php
echo "<ul class='pagination__option '>";
  
// button for first page
if($page>1){
    echo "<a href='{$page_url}' title='Go to the first page.'>";
        echo "First";
    echo "</a>";
}
  
// calculate total pages
$total_pages = ceil($total_rows / $records_per_page);
  
// range of links to show
$range = 2;
  
// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
  
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
  
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
  
        // current page
        if ($x == $page) {
            echo "<a href=\"#\">$x <span class=\"sr-only\">(current)</span></a>";
        } 
  
        // not current page
        else {
            echo "<a href='{$page_url}page=$x'>$x</a>";
        }
    }
}
  
// button for last page
if($page<$total_pages){
    echo "<a href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
        echo '<i class="fa fa-angle-right"></i>';
    echo "</a>";
}
  
echo "</ul>";
?>