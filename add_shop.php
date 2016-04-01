<?php

require_once __DIR__.'/db_connect.php';
$db = new DB_CONNECT();
$item = '';
$price = '';
$status = 'Debit';
$balance = '';
$total_row_url = "http://localhost/office/total_row.php";
$total_row_json = file_get_contents($total_row_url);
$total_row_obj = json_decode($total_row_json);
if($total_row_obj->success==1){
    if($total_row_obj->total_row>0){
        $last_balance_url = "http://localhost/office/last_balance.php";
        $last_balance_json = file_get_contents($last_balance_url);
        $last_balance_obj = json_decode($last_balance_json);
        $balance = $last_balance_obj->balance;
    }
    else{
        $balance = '0';
        echo 'No row(s) found';
    }
}
else{
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
//echo $obj->success;


if (isset($_POST['submit_data'])) {
    $item = $_POST['item'];
    $price = $_POST['price'];
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
    function add_price($b, $p){
        $value = $b - $p;
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
        <div class="container">
            <div class="col-sm-12" >
                <h1 class="h11" >Add Your Shop</h1>
                <form action="" method="post">
                    <div class="form_row">
                        <div class="col-sm-6">
                            <input type="text" placeholder="Item Name" class="textbox" name="item"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Price" class="textbox" name="price"/>
                        </div>
                        <input type="submit" value="Add Shopping" class="button_new" name="submit_data"/>
                    </div>
                </form>
            </div>
            <div class="col-sm-6" style="text-align: left;">
                <h4>
                <a href="http://localhost/office/index.php" style="text-decoration: none;">Home</a>
                </h4>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <h4>
                <a href="http://localhost/office/add_fund.php" style="text-decoration: none;">Add Your Fund Here</a>
                </h4>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
