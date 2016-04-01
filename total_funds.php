<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ .'/db_connect.php';
$response = array();
$db = new DB_CONNECT();
$result = mysql_query("SELECT SUM(price) AS total FROM transactions WHERE status = 'Credit'") or die(mysql_error());
if (mysql_num_rows($result) > 0) {
    $response["success"] = 1;
    $response["message"] = "Data Retrieve Successful";
    $row = mysql_fetch_array($result);
    $response["total_funds"] = $row["total"];
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "Data Retrieve Unsuccessful";
    echo json_encode($response);
}
?>

