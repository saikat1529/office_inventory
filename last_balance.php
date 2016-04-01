<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $response = array();
    require_once __DIR__.'/db_connect.php';
    $db = new DB_CONNECT();
    $result = mysql_query("SELECT balance FROM transactions ORDER BY tid DESC LIMIT 1") or die(mysql_error());
    if(mysql_num_rows($result)>0){
        $response["success"]=1;
        $response["message"]="Data Retrieved Successfully";
        $row = mysql_fetch_array($result);
        $response["balance"]= $row["balance"];
        echo json_encode($response);
    }
    else{
        $response["success"]=0;
        $response["message"]="No Data Found";
        $response["balance"]= 0;
        echo json_encode($response);
    }
?>
