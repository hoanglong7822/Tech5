<?php 
    include ("../../../conn.php");
    $id = $_POST['id'];
    if ($_POST["type"] == 'delete')
    {
        $conn -> query("UPDATE `usr` SET `is_deleted` = 1 WHERE `id` = '$id'");
    }
    else
    {
        $conn -> query("UPDATE `usr` SET `is_deleted` = 0 WHERE `id` = '$id'");
    }  
?> 