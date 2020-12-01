<?php
include "config.php";
$name = $_POST['name'];
$phone = $_POST['phone'];
$temp_query = "INSERT INTO `tab1`(`name`, `mobile`, `dbName`) VALUES ('$name','$phone','$name')";
$query = mysqli_query($con,$temp_query);
if(isset($_POST['submit']))
{
    $user = "root";
    $pass = "";
    $server = 'localhost';
    $db = $name;
    $conn = new mysqli($server, $user, $pass);
    $temp_quer = "CREATE DATABASE `{$name}`";
    $res = $conn->query($temp_quer);
    if($res)
    {
        echo "Database Created";
    }

    $con2 = mysqli_connect($server,$user,$pass,$db);
    $temp = "CREATE TABLE `data` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `mobile` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $new_query = mysqli_query($con2,$temp);
    if($new_query)
    {
        echo "Table Created!!";
        $ins_quer = "INSERT INTO `data` (`name`,`mobile`) VALUES ('$name','$phone')";
        $ins_query = mysqli_query($con2,$ins_quer);
        if($ins_query)
        {
            echo "Data Inserted into the table";
        }
        else
        {
            echo "There is some technical error!!";
        }
    }
    else{
        echo "There is some technical error!!";
    }
}
else
{
    echo "Data Not Inserted due to some technical error";
}

?>