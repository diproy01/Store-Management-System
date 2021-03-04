<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ISOLUTION - Accounts View</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/date_pic/date_input.css">
    <link rel="stylesheet" href="lib/auto/css/jquery.autocomplete.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="lib/auto/js/jquery.autocomplete.js "></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#from_sales_date').jdPicker();
            $('#to_sales_date').jdPicker();
        });
	
	
	
	
        $(function () {
			$('html').bind('keypress', function(e)
			{
				if(e.keyCode == 13)
				{
					return false;
				}
			});
			
        });

    </script>
    <script>
  
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57)
                    return false
            }
        }


    </script>


</head>
<body>

<!-- TOP BAR -->
<?php include_once("tpl/top_bar.php"); ?>
<!-- end top-bar -->


<!-- HEADER -->
<?php include_once("tpl/header.php"); ?>
<!-- end header -->


<!-- MAIN CONTENT -->
<div id="content">

    <div class="page-full-width cf">

        <div class="side-menu fl">

            <h3>Account</h3>
            <ul>
                <li><a href="accounts.php">Add Account</a></li>
                <li><a href="accounts_view.php">View Account</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Accounts View </h3>
                    <span class="fr expand-collapse-text">Click to collapse</span>
                    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    <table>
                        <form action="" method="post" name="search">
						<span style="width:50px; float: left;">From:</span> <input name="from_sales_date" type="text" id="from_sales_date"
                                               style="width:80px; float: left;">
											   
									<span style="width:50px; float: left; text-align: center;">To:</span><input name="to_sales_date" type="text" id="to_sales_date" style="width:80px; float: left;">	   

                            &nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue   text-upper"
                                               value="Search">
                        </form>
                        <form action="" method="get" name="limit_go">
                            Page per Record<input name="limit" type="text" class="round my_text_box" id="search_limit"
                                                  style="margin-left:5px;"
                                                  value="<?php if (isset($_GET['limit'])) echo $_GET['limit']; else echo "50"; ?>"
                                                  size="3" maxlength="3">
                            <input name="go" type="button" value="Go" class=" round blue my_button  text-upper"
                                   onclick="return confirmLimitSubmit()">
                        </form>
				
                        <form name="deletefiles" action="delete.php" method="post">
						<!--
                            <input type="hidden" name="table" value="supplier_details">
                            <input type="hidden" name="return" value="accounts_view.php">
                            <input type="button" name="selectall" value="SelectAll"
                                   class="my_button round blue   text-upper" onClick="checkAll()"
                                   style="margin-left:5px;"/>
                            <input type="button" name="unselectall" value="DeSelectAll"
                                   class="my_button round blue   text-upper" onClick="uncheckAll()"
                                   style="margin-left:5px;"/>
                            <input name="dsubmit" type="button" value="Delete Selected"
                                   class="my_button round blue   text-upper" style="margin-left:5px;"
                                   onclick="return confirmDeleteSubmit()"/>

						-->
                            <table>
                                <?php
								if (isset($_POST['Search'])) {
								
								    if (isset($_GET['from_sales_date']) && isset($_GET['to_sales_date']) && $_GET['from_sales_date'] != '' && $_GET['to_sales_date'] != '') {

        error_reporting(0);
        $selected_date = $_GET['from_sales_date'];
        $selected_date = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date);
        $fromdate = $mysqldate;
        $selected_date = $_GET['to_sales_date'];
        $selected_date = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date);

        $todate = $mysqldate;
echo "<tr><td>".$fromdate."</td></tr>";
echo "<tr><td>".$todate."</td></tr>";

                            </table>
                        </form>


                </div>
                <!-- end content-module-main -->


            </div>
            <!-- end content-module -->


        </div>
    </div>
    <!-- end full-width -->

</div>
<!-- end content -->


<!-- FOOTER -->
<div id="footer">
    <p>Any Queries email to <a target="blank" href="http://ihelpbd.com/">info@ihelpbd.com</a>.
    </p>

</div>
<!-- end footer -->

</body>
</html>