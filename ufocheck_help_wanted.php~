<?
//load constantes
if (is_file('config.php')) {
        require_once('config.php');
}
//set charset
ini_set("default_charset",'windows-1251');//utf-8
ini_set('display_errors', 1);
set_time_limit(600);

//create 

$MyArrayOfAvailItems=array();

    for($i = 0; $i < 200; $i++) {
		
		
		
			$model_id	= 5000+$i;
			//echo $model_id;
			//echo '
			//		';            
			array_push($MyArrayOfAvailItems, $model_id);	
		
	}	
		


echo $MyArrayOfAvailItems[0];
echo '
					';
echo sizeof($MyArrayOfAvailItems);
echo '
					';

$MyArrayOfFindedItems=array();
//$item_container = "bx_catalog_item_container";
$item_container = "Сожалеем";
/* Convert, target encoding, source encoding*/
$item_container = mb_convert_encoding($item_container, "windows-1251", "utf-8");

function populateArray2($model, $data) {
	global $model;
	global $data;
	global $item_container;
	global $recurse;
	global $MyArrayOfFindedItems;
	/*
	if ($recurse === 1) {
		echo $item_container;
		echo $data;
		echo 'hello world '.$model;
		echo '
			';
	}
	*/
	$pos = strpos($data, $item_container);
	//echo $pos;
	if ($pos !== false) {
		array_push($MyArrayOfFindedItems, $model);
		echo $model;
		echo ' 
				';
		//$recurse = 1;	
		//populateArray2($model, $data, $recurse);
	} else {
		//echo 'not found';
	} 
	
}
foreach ($MyArrayOfAvailItems as $model) {
    //$item_id = 5121;
	//echo $model;
	//echo '
	//				';
	$data = file_get_contents('https://ufopeople.ru/catalog/?q='.$model);
	//echo $data;
	//echo '
	//				';
	$recurse = 0;	
	populateArray2($model, $data);
	
}



//echo $data;
echo '
	';
echo memory_get_usage(true)."\n";
echo memory_get_peak_usage(true)."\n";
//echo sizeof($MyArrayOfFindedItems);
/*
foreach ($MyArrayOfFindedItems as $checkit) {
    echo '
					';
	echo $checkit;	
}
*/
