<?php
include "../assets/fxn.php";
if (isset($_SESSION["UID"]) == null) {
?>
    <script type="text/javascript">
        window.location = 'logout.php';
    </script>
    <?php
}
$id = $_SESSION["UID"];
$name = e_d('d', $_SESSION["fullName"]);
$email = e_d('d', $_SESSION["emailAddress"]);
$phone = e_d('d', $_SESSION["phoneNumber"]);
$departmentID = $_SESSION["departmentID"];
$qualificationID = $_SESSION["qualificationID"];
$hospitalID = $_SESSION["hospitalID"];


if (isset($_POST["submit"])) {
    $remarks = $_POST['remarks'];
    $remarks = e_d('e', $remarks);
    $procedure = e_d('e', $_POST['procedure']);
    $reason = e_d('e', $_POST['reason']);
    $date = $_POST['date'];
    $ipdId = $_POST['ipdId'];
    $pid = getThis("SELECT `patientId` FROM `ipdappointment` WHERE `id` = '$ipdId' ");
    $patientID = $pid[0]['patientId'];
    $temp_res = doThis("UPDATE `ipdappointment` SET `enabled` = '-1' WHERE `id` = '$ipdId'");
    $res = doThis("INSERT INTO `ipdappointment`( `patientId`, `doctorId`, `hospitalId`, `remarks`,`procedureToFollow`, `reason`, `admissionDate`, `generatedAt`) VALUES ('$patientID','$id','$hospitalID','$remarks', '$procedure', '$reason' ,'$date',CURRENT_TIMESTAMP())");
    if ($res) {
    ?>
        <script>
            alert("Notification Sent To The Concerned Patient!");
            // window.location = "../ipdschedule.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Some Technical Error!");
            // window.location = "../ipdschedule.php";
        </script>
<?php
    }
}
