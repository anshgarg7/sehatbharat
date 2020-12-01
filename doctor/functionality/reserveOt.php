<?php
include "../assets/fxn.php";
$id = $_SESSION['UID'];
if (isset($_POST['submit'])) {
    $prepTime = $_POST['prepTime'];
    $otId = $_POST['otId'];
    $pid = $_POST['patientId'];
    $pid = e_d('d', $pid);
    $startTime = $_POST['otTime'];

    $temp_endTime = date_create($startTime);
    date_add($temp_endTime, date_interval_create_from_date_string($prepTime . 'hours'));
    $temp_endTime = $temp_endTime->format('Y-m-d H:i:s');
    // echo $startTime . "<br>" . $temp_endTime . "<br>" . $pid;
    $res = doThis("INSERT INTO `otbooking`( `otId`, `doctorId`, `patientId`, `startingTime`, `endingTime`, `generatedAt`) VALUES ('$otId','$id','$pid','$startTime', '$temp_endTime', CURRENT_TIMESTAMP() )");
    if ($res) {
?>
        <script>
            alert("O.T. Reserved !!");
            window.close();
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Some Technical Error!!");
            window.location = "../otBook.php";
        </script>
<?php
    }
}
?>