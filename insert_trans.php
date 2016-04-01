<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['item']) && isset($_POST['price']) && isset($_POST['status'])&&isset($_POST['balance'])) {
 
    $item = $_POST['item'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $balance = $_POST['balance'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();


    // mysql inserting a new row
    $result = mysql_query("INSERT INTO transactions(item, price, status, balance) VALUES('$item', '$price', '$status','$balance')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Record added successfully";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>