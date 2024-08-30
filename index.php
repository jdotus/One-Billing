<?php
    include 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Billing</title>

    <link rel="stylesheet" href="style.css">

</head>
    <body>
        <?php 
           include 'dbcon.php'; // This should contain the database connection code
           
            $con = mysqli_connect("localhost", "root", "", "sale invoice");
            
            
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

       if(isset($_POST['submit'])) {
                $invoiceNo = mysqli_real_escape_string($con, $_POST["invoice_no"]);
                $name = mysqli_real_escape_string($con, $_POST["name"]);
                $invoiceDate = date("Y-m-d", strtotime($_POST["invoice_date"]));
                $description = mysqli_real_escape_string($con, $_POST["description"]);
                $address = mysqli_real_escape_string($con, $_POST["address"]);
                $total_sales = mysqli_real_escape_string($con, $_POST["total_sales"]);
                $vat = mysqli_real_escape_string($con, $_POST["vat"]);
                $total = mysqli_real_escape_string($con, $_POST["total"]);

                $itemDescription = mysqli_real_escape_string($con,$_POST["item_description"]);
                $totalPrice = mysqli_real_escape_string($con, $_POST["total_price"]);
            
                // Prepare and execute SQL statement
                $firstStmnt = $con->prepare("INSERT INTO info (si_num, sold_to, si_date, description, address, total_sale, vat, total_amount_payable) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                if ($firstStmnt === false) {
                    die('Prepare() failed: ' . htmlspecialchars($con->error));
                }

                $firstStmnt->bind_param("ssssssss", $invoiceNo, $name, $invoiceDate, $description, $address, $total_sales, $vat, $total);

                if($firstStmnt->execute()) {
                    $infokey = $con->insert_id;

                    $secondStmnt = $con->prepare("INSERT INTO sales_2 (item_description, total_price, info_key) VALUES (?, ?, ?)");
                    $secondStmnt->bind_param("sss", $itemDescription, $totalPrice,  $infokey);

                    $secondStmnt->execute();

                    echo "DATA INSERTED";
                } else {
                    echo "FAILED TO INSERT IN INFO DB";
                }

                $firstStmnt->close();
                $secondStmnt->close();
            }
        ?>

        <div class="modal-content">

            <h2 class="title">One Billing</h2>

            <div class="container">

                <form action="index.php" method="post" autocomplete="off">
                    <div class="display-flex">
                        <div class="left-side">
                            <label for="invoice_no">INVOICE NO: </label>
                            <input type="number" id="invoice_no" name="invoice_no">
                            
                            <label for="invoice_date">INVOICE. DATE: </label><br>
                            
                            <input type="date" id="invoice_date" name="invoice_date"  value="<?php echo date("Y-m-d");?>">
                            <br>
                            
                        </div>
                        <div class="right-side">

                            <label for="name">NAME: </label>
                            <input type="text" id="name" name="name">
                            
                            <label for="address">ADDRESS: </label>
                            <input type="text" id="address" name="address">
                            
                            <label for="description">DESCRIPTIONS: </label>   
                            <input type="text" id="description" name="description">
                            
                        </div>
                    </div>
                    
                    <div class="bottom-part display-flex-bottom" id="input-container">

                        <div id="inline-block-description">
                            <label class="item_description" for="item_description">ITEM DESCRIPTION: </label>
                            
                            <input class="item_description" type="text" id="item_description" name='item_description'>
                            
                        </div>

                        <div id="inline-block-description">
                            <label class="total_price" for="total_price">TOTAL PRICE: </label>
                            
                            <input class="total_price" type="text" id="total_price" name='total_price'>
                            
                        </div>
                       
                    </div>

                    <div class="display-flex-VAT">
                        <div class="right-side">

                            <label for="vat">VAT: </label>
                            <input type="number" step="0.01" min="0" id="vat" name="vat" >
                            
                            <label for="total_sales">TOTAL SALES: </label>
                            <input type="text" step="0.01" min="0" id="total_sales" name="total_sales" >
                            
                            <label for="total">TOTAL: </label>
                            <input type="number" step="0.01" min="0" id="total" name="total" >
            
                        </div>
                    </div>


                    <div class="inputContainer">
                        <button class="submit" type="submit" name="submit">SAVE INVOICE</button>
                    </div>

                </form>
            </div>
            
        </div>
        <script src="script.js"></script>

    </body>
</html>