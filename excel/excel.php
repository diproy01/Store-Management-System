
<?php
include_once("../init.php");
$Use_Title = 1;
$now_date = date('l jS \ F Y h:i:s A');
//define title for .doc or .xls file: EDIT this if you want
$title = "\t\t\t\t\t\t--- Available Stock Details---  ".""."\n\t\t\t\t\t\tAdol IT Ltd\n\t\t\t\t\t".$now_date."\n";//"Dump For Table $DB_TBLName from Database $DB_DBName on $now_date";
//For CSV File
//$title = ",,,,,,--- Available Stock Details---  ".""."\n,,,,,,Adol IT Ltd\n,,,,,".$now_date."\n\n";
	//$file_type = "text/csv";	
	//$file_ending = "csv";
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
//header info for browser: determines file type ('.xls')

header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=Available_stock_details__$now_date.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

/*	Start of Formatting for Word or Excel	*/

	/*	FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character

	
	$quantity1 = $db->queryUniqueValue("SELECT sum(stock_quatity) FROM stock_details");
	$sum1 = $db->queryUniqueValue("SELECT sum(stock_quatity*company_price) FROM stock_details");

	
//For xlx
echo "\t\t\t\tTotal Number of Product: ".$quantity1."\t\t\t\t Total Product Cost: ". $sum1."\n";
echo "\t\t\t\t No \t Stock Name \t\t Category \t\t Stock \t Total Price \n";


//For CSV
//echo ",,,,Total Number of Product: ".$quantity.",,,, Total Product Cost: ". $sum."\n";
//echo ",,,,, No , Stock Name , Category , Stock , Total Price \n";
$i = 1;
$sql = "SELECT * FROM stock_avail ORDER BY id DESC";
$result = mysqli_query($db->connection, $sql);
while ($row = mysqli_fetch_array($result)) {
	echo "\t\t\t\t";
	echo $i."\t";
    echo $row['name']."\t\t";
	echo $row['category']."\t\t"; 
	$quantity = $db->queryUniqueValue("SELECT sum(stock_quatity) FROM stock_details WHERE stock_name='" . $row['name'] . "'");
    echo $quantity."\t"; 
	$sum = $db->queryUniqueValue("SELECT sum(stock_quatity*company_price) FROM stock_details WHERE stock_name='" . $row['name'] . "'");
    echo $sum."\t\n"; 
$i++;
}
	//For CSV File
	/*
	$i = 1;
$sql = "SELECT * FROM stock_avail ORDER BY id DESC";
$result = mysqli_query($db->connection, $sql);
while ($row = mysqli_fetch_array($result)) {
	echo ",,,,,";
	echo $i.",";
    echo $row['name'].",";
	echo $row['category'].","; 
	$quantity = $db->queryUniqueValue("SELECT sum(stock_quatity) FROM stock_details WHERE stock_name='" . $row['name'] . "'");
    echo $quantity.","; 
	$sum = $db->queryUniqueValue("SELECT sum(stock_quatity*company_price) FROM stock_details WHERE stock_name='" . $row['name'] . "'");
    echo $sum.",\n"; 
$i++;
}	
*/	