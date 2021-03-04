<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ISOLUTION - Accounts</title>

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
   
    <script>
function load_data() {
    
    var str= this.document.getElementById("bill_no").value;
    
  if (str=="") {
    document.getElementById("item").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("item").value=this.responseText;
    }
  }
  xmlhttp.open("POST","dip.php?q="+str,true); 
  xmlhttp.send();
}
</script>

    <script type="text/javascript">
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

                    <h3 class="fl">Add Cost Account </h3><span class="fl">- Add New ( Control +2)</span>
                    <span class="fr expand-collapse-text">Click to collapse</span>
                    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    
		  
                    <form name="form1" method="post" id="form1" action="">
                       
						<table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
								<td> &nbsp;</td>
                                <td>Cost Type</td>
                                <td><input name="cost_type" placeholder="Enter Cost Type" type="text" id="cost_type"
                                           maxlength="20" class="round default-width-input" style="width:130px " required></td>

                                <td>Amount</td>
                                <td><input name="amount" required placeholder="Enter Amount" type="text" id="amount"
                                           maxlength="10" class="round default-width-input"/></td>

                                <td>Details</td>
                                <td><input name="details" placeholder="Write Details" type="text" id="details"
                                           maxlength="100" class="round default-width-input" style="width:120px "/></td>
                                            

                            </tr>
							<tr> <td> &nbsp;</td> <td> &nbsp;</td> <td> &nbsp;</td> <td> &nbsp;</td> <td> &nbsp;</td> <td> &nbsp;</td><td> &nbsp;</td></tr>
                            <tr>
								<td> &nbsp;</td>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="save" value="Add">
                                </td>
                                <td> (Control + S)
                                    <input class="button round red   text-upper" type="reset" name="Reset"
                                           value="Reset"></td>
                                <td> &nbsp;</td>
                                <td> &nbsp;</td>
								<td> &nbsp;</td>
								<td> &nbsp;</td>
                                
                            </tr>
                        </table>
                    </form>
					<?PHP
					 if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }
					if (isset($_POST['save'])) {
						$type = $_POST['cost_type'];
						$details = $_POST['details'];
						$amount = $_POST['amount'];
						
						$db->query("insert into costing (cost_type, description, amount) values ('$type','$details','$amount')");
					$msg = "<br><font color=green size=6px >Account Added successfully !</font>";
                            echo "<script>window.location = 'accounts.php?msg=$msg';</script>";

					}
					?>
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