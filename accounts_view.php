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
		function show_account_data() { 
  if (window.XMLHttpRequest) {
	  var str1 = document.getElementById('from_sales_date').value;
	  var str2 = document.getElementById('to_sales_date').value;
	  
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("show_values").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","accounts_view_reports.php?p="+str1+"&q="+str2,true); 
  xmlhttp.send();
}
	
  
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
          
						<span style="width:50px; float: left;">
						From:</span> <input name="from_sales_date" type="text" id="from_sales_date"
                                               style="width:120px; float: left;" class="my_button round text-upper">
											   
									<span style="width:50px; float: left; text-align: center;">To:</span><input name="to_sales_date" type="text" id="to_sales_date" style="width:120px; float: left;" class="my_button round text-upper">	   

                            &nbsp;&nbsp;<input onclick="show_account_data()" name="Search" type="submit" class="my_button round blue   text-upper"
                                               value="Search">
                 
					
					<div id="show_values" style="width: 100%; padding-top: 30px;">

					</div>

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