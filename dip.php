<?php
/*
$con = mysqli_connect('localhost','isolutio_dipak','dipak@@1234');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"isolutio_ihelpsolution");
$q = mysqli_real_escape_string($con,$_REQUEST['q']);
$sql="SELECT stock_name FROM stock_details WHERE barcode = '$q'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo $row['stock_name'];
mysqli_close($con);
*/

<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE barcode ='".$_POST['barcode']."'");
//$cost = $line->company_price;
$sell = $line->selling_price;
$stock_id = $line->stock_name;
$model = $line->stock_brand;
$stock = $line->stock_quatity;

if ($line != NULL) {
	$arr = array("sell" => "$sell", "stock" => "$stock", "model" => "$model", "guid" => "$stock_id");
    //$arr = array("guid" => $stock_id);
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);

}
?>

