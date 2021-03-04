<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT * FROM stock_details where stock_quatity >0 ");
while ($line = $db->fetchNextObject()) {

    if (strpos(strtolower($line->stock_brand), $q) !== false) {
        echo "$line->stock_brand\n";

    }
}

?>
