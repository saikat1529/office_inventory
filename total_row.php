<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// array for JSON response
$response = array();
// include db connect class
    require_once __DIR__ . '/db_connect.php';
    // connecting to db
    $db = new DB_CONNECT();
    $result = mysql_query("SELECT COUNT(*) AS count FROM transactions") or die(mysql_error());
    if (mysql_num_rows($result) > 0) {
        $response["success"] = 1;
        $row = mysql_fetch_array($result);
        $response["total_row"]=$row["count"];
        echo json_encode($response);
    }
    else{
         $response["success"] = 0;
        $response["message"] = "No products found";
        echo json_encode($response);
    }
?>

