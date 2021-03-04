<?php
include_once("init.php");// Use session variable on this page. This function must put on the top of page.
require_once("sales_report.php");
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
} else {
    //if (isset($_GET['from_sales_date']) && isset($_GET['to_sales_date']) && $_GET['from_sales_date'] != '' && $_GET['to_sales_date'] != '') {

       // error_reporting(0);
        //$selected_date = $_GET['from_sales_date'];
        //$selected_date = strtotime($selected_date);
        //$mysqldate = date('Y-m-d H:i:s', $selected_date);
        //$fromdate = $mysqldate;
        //$selected_date = $_GET['to_sales_date'];
       // $selected_date = strtotime($selected_date);
        //$mysqldate = date('Y-m-d H:i:s', $selected_date);
		
		
		$filename = "dipak";
        //$todate = $mysqldate;
		$file_ending = "xls";
		
		
		//$line4 = $db->queryUniqueObject("SELECT * FROM store_details ");
		//$tot = $db->queryUniqueValue("SELECT sum(subtotal) FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		//$payment = $db->queryUniqueValue("SELECT sum(payment) FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		//$profit = $db->queryUniqueValue("SELECT sum(profit) FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		//$balance = $db->queryUniqueValue("SELECT sum(balance) FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		$result = $db->query("SELECT * FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		
		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=$filename.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		
		$sep = "\t";
		print "\n";print "\n";print "\n";
		
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
			echo mysql_field_name($result,$i) . "\t";
			}
		while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
	//}
}