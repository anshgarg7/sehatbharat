<?php
include "../assets/fxn.php";

if(isset($_POST['submit']))
{
    $startDate = $_POST['leavefrom'];
    $endDate = $_POST['leaveto'];
    $doctorId = $_SESSION["UID"];
    $hospitalId = $_SESSION["hospitalID"];
    $res = doThis("INSERT INTO `doctorleaves`(`doctorID`, `hospitalID` , `leaveFrom`, `leaveTo`, `generatedAt`,`enabled`) VALUES ('$doctorId', '$hospitalId' ,'$startDate','$endDate',CURRENT_TIMESTAMP(),'0')");
    if($res)
    {
        ?>
        <script>
        alert("Leave Application Received!!");
        window.location = "../dashboard.php";
        </script>
        <?php
    }
    else{
        ?>
        <script>
        alert("Some Technical Error!!");
        window.location = "../dashboard.php";
        </script>
        <?php
    }
}
?>