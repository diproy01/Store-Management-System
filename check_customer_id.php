<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT MAX(id) as maxid FROM customer_details");

$id = $line->maxid;
$id = $id + 1;
if ($line != NULL) {

    $arr = array("id" => "$id");
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);

}
?>