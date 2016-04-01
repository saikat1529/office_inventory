<?php
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();
$item = 'Fund Added';
$price = '';
$status = 'Credit';
$balance = '';
$total_row_url = "http://localhost/office/total_row.php";
$total_row_json = file_get_contents($total_row_url);
$total_row_obj = json_decode($total_row_json);
if ($total_row_obj->success == 1) {
    if ($total_row_obj->total_row > 0) {
        $last_balance_url = "http://localhost/office/last_balance.php";
        $last_balance_json = file_get_contents($last_balance_url);
        $last_balance_obj = json_decode($last_balance_json);
        $balance = $last_balance_obj->balance;
    } else {
        $balance = '0';
        echo 'No row(s) found';
    }
} else {
    echo 'Something went wrong with Total Row';
}
//var_dump(json_decode($total_row_json));
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_URL, $total_row_url);
//$result = curl_exec($ch);
//curl_close($ch);
//
//$obj = json_decode($result);
//echo $obj->success

if (isset($_POST['submit_data'])) {
    $price = $_POST['fund'];
    $add_function = new Add();
    $balance = $add_function->add_price($balance, $price);
    $result = mysql_query("INSERT INTO transactions(item, price, status, balance) VALUES('$item', '$price', '$status','$balance')");
    if ($result) {
        // successfully inserted into database
        echo 'Data Added Succesfully';
    } else {
        // failed to insert row
        echo 'No Data Added';
    }
}

class Add {

    function add_price($b, $p) {
        $value = $b + $p;
        return $value;
    }

}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Fund Add</title>
        <link rel="stylesheet" href="master.css"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
    </head>
    <body>
        <div class="container" style="margin-top: 10px;">
            <div class="col-sm-4 h11">
      
                    <h1><b>BALANCE</b></h1>
                    <h3><i>BDT 2000.00</i></h3>
            </div>
            <div class="col-sm-4 h11">
                    <h1><b>Expenses</b></h1>
                    <h3><i>BDT 2000.00</i></h3>
            </div>
            <div class="col-sm-4 h11">
                    <h1><b>Funds</b></h1>
                    <h3><i>BDT 2000.00</i></h3>
            </div>
            <div class="col-sm-12 h11">
                <h1><b>Transaction</b></h1>
                <div class="col-sm-4 white">
                    <h1><b>Credit</b></h1>
                    <h2>1</h2>
                </div>
                <div class="col-sm-4 white">
                    <h1><b>Debit</b></h1>
                    <h2>3</h2>
                </div>
                <div class="col-sm-4 white">
                    <h1><b>All</b></h1>
                    <h2>4</h2>
                </div>
            </div>
            <div class="col-sm-12 h11">
                <h3 class="col-sm-6" style="text-align: left;">Recent Transaction(s)</h3>
                <h3 class="col-sm-6" style="text-align: right;">Date</h3>
                <h4 class="col-sm-4" style="text-align: left;">Item Name</h4>
                <h4 class="col-sm-4" style="text-align: center;">Price</h4>
                <h4 class="col-sm-4" style="text-align: right;">Status</h4>
            </div>
            <div class="col-sm-6" style="text-align: left;">
                <h4>
                    <a href="http://localhost/office/add_fund.php" style="text-decoration: none;">Add Your Fund Here</a>
                </h4>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <h4>
                    <a href="http://localhost/office/add_shop.php" style="text-decoration: none;">Add Your Shopping Here</a>
                </h4>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
