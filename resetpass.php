<?php
    include("conn.php");
    session_start();
    if(isset($_POST['re_password']))
    {
    $id = $_POST['id'];
    $new_pass=$_POST['new_pass'];
    $re_pass=$_POST['re_pass'];
    $chg_pwd=mysqli_query($conn, "select * from usr");
    $chg_pwd1=mysqli_fetch_array($chg_pwd);
    $data_pwd=$chg_pwd1['password'];
    if($data_pwd==$old_pass)
    {
        if($new_pass==$re_pass)
        {
        $update_pwd=mysqli_query($conn, "update usr set password='$new_pass' where id='$id'");
        echo "<script>alert('Update Sucessfully'); window.location='index.php'</script>";
        }
    else
    {
        echo "<script>alert('Your new and Retype Password is not match'); window.location='index.php'</script>";
    }
    }
    else
    {
    echo "<script>alert('Your old password is wrong'); window.location='index.php'</script>";
    }
    }
?>