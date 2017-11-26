<?
//load constantes
if (is_file('config.php')) {
        require_once('config.php');
}
//set charset
ini_set("default_charset",'windows-1251');//utf-8
ini_set('display_errors', 1);
set_time_limit(600);
//load stack of items to check them
$conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
/* change character set to utf8 */
if (!mysqli_set_charset($conn, "utf8")) {
  //  printf("Error loading character set utf8: %s\n", mysqli_error($conn));
    exit();
} else {
  //  printf("Current character set: %s\n", mysqli_character_set_name($conn));
}
$LowBorder  = ($_POST["name"]-1)*100;
$HighBorder = ($_POST["name"])*100;
//$LowBorder  = 0;
//$HighBorder = 400;
$query_line = "SELECT 
 oc_product.product_id, model, oc_product.quantity, oc_product.status
 FROM oc_product
 WHERE (oc_product.manufacturer_id = 11 ||
 oc_product.manufacturer_id = 12 ||
 oc_product.manufacturer_id = 13) &&
 oc_product.product_id > ".$LowBorder." && oc_product.product_id < ".$HighBorder. 
 "&& oc_product.status = 1 
 ORDER BY oc_product.product_id";
// oc_product.product_id > ".$LowBorder." && oc_product.product_id < ".$HighBorder.
//echo $query_line;
echo "<html><body>";
$query = mysqli_query($conn, $query_line);

$field = mysqli_field_count($conn);
// create line with field names

//create 
// loop through database query and fill export variable
$MyArrayOfAvailItems=array();
echo "all items in range from your store"."<br>";
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
		if ($i==1) {
			$model_id	= $row[mysqli_fetch_field_direct($query, $i)->name];
			echo $model_id;
			echo ' ';            
			array_push($MyArrayOfAvailItems, $model_id);	
		}
	}	
}
echo "<br>"."total number for checking is ";
echo sizeof($MyArrayOfAvailItems);
echo ' ';

$MyArrayOfFindedItems=array();
$item_container  = "t1 nety";
/* Convert, target encoding, source encoding*/
//$item_container = mb_convert_encoding($item_container, "windows-1251", "utf-8");

function populateArray2($model, $data) {
	global $model;
	global $data;
	global $item_container;
	global $item_container2;
	global $recurse;
	global $MyArrayOfFindedItems;
	$pos = strpos($data, $item_container);
	//echo $pos;
	if ($pos !== false) {
		echo "<br>";
		array_push($MyArrayOfFindedItems, $model);
		echo " not found at all model ".$model;		
		//$recurse = 1;	
		//populateArray2($model, $data, $recurse);
	} else {
		//echo 'not found';
	}
}
foreach ($MyArrayOfAvailItems as $model) {
	$data = file_get_contents('http://winner-bagz.ru/catalog/?q='.$model);
	$recurse = 0;	
	populateArray2($model, $data);
}
echo "<br>";
echo "<a href=\"delune.html\">back to input</a>";
echo "</body></html>";
