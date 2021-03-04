<?php
include_once("init.php");

  $selected_date = $_GET['p'].' 00:00:01';
        $selected_date11 = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date11);
        $fromdate = $mysqldate;
        $selected_date = $_GET['q'].' 23:59:59';
        $selected_date2 = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date2);

        $todate = $mysqldate;
		
		$cost = $db->queryUniqueValue("SELECT sum(amount) FROM costing where date BETWEEN '$fromdate' AND '$todate' ");
		$profit = $db->queryUniqueValue("SELECT sum(subtotal) FROM stock_sales where date BETWEEN '$fromdate' AND '$todate' ");
		$discount = $db->queryUniqueValue("SELECT sum(dis_amount) FROM stock_sales where count1=1 AND date BETWEEN '$fromdate' AND '$todate' ");
		$pro_profit = $profit - $discount;
		$net_profit = $pro_profit - $cost;
		echo "<p style='font-weight: bold; padding-left: 250px;'>
		Date From - &nbsp;".date('Y-m-d', $selected_date11)."&nbsp;&nbsp; To &nbsp;&nbsp;".date('Y-m-d', $selected_date2)."</p>";
echo "<table style='width: 80%;'><tr style='background: yellow;'><td style='width: 20%;'>Total Profit: ".$pro_profit."</td><td style='width: 30%;'> Total Cost: ".$cost."</td><td style='width: 20%;'> Net Profit: ".$net_profit."</td><td style='width: 30%;'>&nbsp;</td></tr>";
echo "<tr><th style='width: 20%;'>Cost Type</th><th style='width: 30%;'>Description </th><th>Amount</th><th style='width: 30%; text-align: center;'>Date</th></tr>";
		$result = $db->query("SELECT * FROM costing where date BETWEEN '$fromdate' AND '$todate' ");
        while ($line = $db->fetchNextObject($result)) {
		$cost_type = $line->cost_type;
		$description = $line->description;
		$amount = $line->amount;
		$date = date('Y-m-d h:i:s a',strtotime($line->date));
echo "<tr><td style='width: 20%;'>$cost_type</td><td style='width: 30%;'>$description </td><td>$amount</td><td >$date</td></tr>";
									}
echo "</table>";

?>

