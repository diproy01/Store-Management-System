<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE barcode ='".$_POST['barcode']."'");
//$cost = $line->company_price;
$sell = $line->selling_price;
$stock_id = $line->barcode;
$stock_name = $line->stock_name;
//$line = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name ='" . $_POST['stock_name1'] . "'");
$stock = $line->stock_quatity;
$model = $line->stock_brand;
$quty = 1;

if ($line != NULL) {
	$arr = array("sell" => "$sell", "stock" => "$stock", "model" => "$model", "quty" => "$quty", "stock_name" => "$stock_name", "guid" => $stock_id);
    //$arr = array("guid" => $stock_id);
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);

}
?>
		<?php
		//include_once("init.php");

		//$line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE stock_name ='" . $_POST['stock_name1'] . "'");
		//$cost = $line->company_price;
		//$sell = $line->selling_price;
		//$stock_id = $line->stock_id;
		//$line = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name ='" . $_POST['stock_name1'] . "'");
		//$stock = $line->quantity;

		//if ($line != NULL) {

		//	$arr = array("cost" => "$cost", "sell" => "$sell", "stock" => "$stock", "guid" => $stock_id);
		//	echo json_encode($arr);

		//} else {
		//	$arr1 = array("no" => "no");
		//	echo json_encode($arr1);

		//}
		?>