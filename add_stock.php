<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ISOLUTION - Add Stock Category</title>

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
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/
        $(document).ready(function () {
            $("#supplier").autocomplete("supplier1.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            $("#category").autocomplete("category.php", {
                width: 160,
                autoFill: true,
                selectFirst: true
            });
            // validate signup form on keyup and submit
            $("#form1").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    stockid: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
//                    cost: {
//                        required: true,
//
//                    },
//                    sell: {
//                        required: true,
//
//                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Stock Name",
                        minlength: "Category Name must consist of at least 3 characters"
                    },
                    stockid: {
                        required: "Please Enter Stock ID",
                        minlength: "Category Name must consist of at least 3 characters"
                    },
//                    sell: {
//                        required: "Please Enter Selling Price",
//                        minlength: "Category Name must consist of at least 3 characters"
//                    },
//                    cost: {
//                        required: "Please Enter Cost Price",
//                        minlength: "Category Name must consist of at least 3 characters"
//                    }
                }
            });

        });
        function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
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

            <h3>Stock Management</h3>
            <ul>
                <li><a href="add_stock.php">Add Stock/Product</a></li>
                <li><a href="view_product.php">View Stock/Product</a></li>
                <li><a href="add_category.php">Add Stock Category</a></li>
                <li><a href="view_category.php">view Stock Category</a></li>
                <li><a href="view_stock_availability.php">view Stock Available</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Add Stock </h3>
                    <span class="fr expand-collapse-text">Click to collapse</span>
                    <span class="fr expand-collapse-text initial-expand">Click to expand</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    <?php
                    //Gump is libarary for Validatoin

                    if (isset($_POST['name'])) {
                        $_POST = $gump->sanitize($_POST);
                        $gump->validation_rules(array(
                            'name' => 'required|max_len,100|min_len,3',
                            'stockid' => 'required|max_len,200',
                            //'barcode' => 'required|max_len,200',
                            //'sell' => 'required|max_len,200',
                            //'cost' => 'required|max_len,200',
                            //'supplier' => 'max_len,200',
                            'category' => 'max_len,200'

                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'stockid' => 'trim|sanitize_string|mysqli_escape',
                            //'barcode' => 'trim|sanitize_string|mysqli_escape',
                            //'sell' => 'trim|sanitize_string|mysqli_escape',
                            //'cost' => 'trim|sanitize_string|mysqli_escape',
                            'category' => 'trim|sanitize_string|mysqli_escape',
                            //'supplier' => 'trim|sanitize_string|mysqli_escape'

                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $stockid = "";
                        //$barcode = "";
                        //$sell = "";
                        //$cost = "";
                        //$supplier = "";
                        $category = "";


                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {


                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                            //$barcode = mysqli_real_escape_string($db->connection, $_POST['barcode']);
                            //$sell = mysqli_real_escape_string($db->connection, $_POST['sell']);
                            //$cost = mysqli_real_escape_string($db->connection, $_POST['cost']);
                            //$supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                            $category = mysqli_real_escape_string($db->connection, $_POST['category']);


                            $count = $db->countOf("stock_avail", "name ='$name' and category = '$category'");
                            if ($count == 1) {
                                echo "<font color=red> Dublicat Entry. Please Verify</font>";
                            } else {

                                if ($db->query("insert into stock_avail(name,quantity,category) values('$name',0,'$category')")){
                                        //$db->query("insert into stock_details(stock_id,barcode,stock_name,stock_quatity,supplier_id,company_price,selling_price,category) values('$stockid','$barcode','$name',1,'$supplier','$cost','$sell','$category')")) 
                                    echo "<br><font color=green size=+1 > [ $name ] Stock Details Added !</font>";
                                    
                                } 
                                
                                else
                                    echo "<br><font color=red size=+1 >Problem in Adding !</font>";

                            }


                        }

                    }


                    ?>

                    <form name="form1" method="post" id="form1" action="">


                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php
                                $max = $db->maxOfAll("id", "stock_details");
                                $max = $max + 1;
                                $autoid = "SD" . $max . "";
                                ?>
                                <td><span class="man">*</span>Stock ID:</td>
                                <td><input name="stockid" type="text" id="stockid" maxlength="200"
                                           class="round default-width-input"
                                           value="<?php echo isset($autoid) ? $autoid : ''; ?>"/></td>
                            
                            </tr>
                            <tr><td></td><td></td></tr>
                            <tr>
                                <td><span class="man">*</span>Category:</td>
                                <td><input name="category" placeholder="ENTER CATEGORY NAME" type="text" id="category"
                                           maxlength="200" class="round default-width-input" required
                                           value="<?php echo isset($category) ? $category : ''; ?>"/></td>
<!--                                <td>Barcode:</td>
                                <td><input name="barcode" type="text" id="stockid" maxlength="200"
                                           class="round default-width-input"
                                           value="//////<?php //echo isset($barcode) ? $barcode : ''; ?>"/></td>-->
                            <tr><td></td><td></td></tr>
                            </tr>

                            <tr>
                                
                                <td><span class="man">*</span>Company Name:</td>
                                <td><input name="name" placeholder="ENTER COMPANY NAME" type="text" id="name"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($name) ? $name : ''; ?>"/></td>
                                

                            </tr>
<!--                            <tr>
                                <td>Cost:</td>
                                <td><input name="cost" placeholder="ENTER COST PRICE" type="text" id="cost"
                                           maxlength="200" class="round default-width-input"
                                           onkeypress="return numbersonly(event)"
                                           value="<?php //echo isset($cost) ? $cost : ''; ?>"/></td>

                                <td>Sell:</td>
                                <td><input name="sell" placeholder="ENTER SELLING PRICE" type="text" id="sell"
                                           maxlength="200" class="round default-width-input"
                                           onkeypress="return numbersonly(event)"
                                           value="<?php //echo isset($sell) ? $sell : ''; ?>"/></td>

                            </tr>

                            <tr>
                                <td>Supplier:</td>
                                <td><input name="supplier" placeholder="ENTER SUPPLIER NAME" type="text" id="supplier"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php //echo isset($supplier) ? $supplier : ''; ?>"/></td>
                                <td>&nbsp;</td>
                            </tr>-->


                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" value="Add">
                                    (Control + S)</td>

                                <td align="right"><input class="button round red   text-upper" type="reset" name="Reset"
                                                         value="Reset"></td>
                            </tr>
                        </table>
                    </form>


                </div>
                <!-- end content-module-main -->


            </div>
            <!-- end content-module -->


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