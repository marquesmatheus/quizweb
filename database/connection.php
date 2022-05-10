<?php
    $conn = mysqli_connect('localhost','user','passwd','db_name');

    mysqli_query($conn,"SET NAMES 'utf8'");
    mysqli_query($conn,"SET character_set_connection=utf8");
    mysqli_query($conn,"SET character_set_client=utf8");
    mysqli_query($conn,"SET character_set_results=utf8");

    if(!$conn){
        echo 'Problem in Connection file.';
    }
?>