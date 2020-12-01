<?php
include "../assets/fxn.php";

if (isset($_POST["submit"])) {
    $reason = $_POST["reason"];
    $reason = e_d('e', $reason);
    $procedure = $_POST["procedure"];
    $procedure = e_d('e', $procedure);
    $remarks = $_POST["remarks"];
    $remarks = e_d('e', $remarks);
    $date = $_POST["date"];
    $doctorId = $_SESSION["UID"];
    $pid = $_SESSION["patientIDforDoctor"];
    $pid = e_d('d', $pid);
    $hospitalId = $_SESSION["hospitalID"];

    $res = doThis("INSERT INTO `ipdappointment`(`patientId`, `doctorId`, `hospitalId`, `remarks`, `procedureToFollow`, `reason`, `admissionDate`, `generatedAt`) VALUES ('$pid','$doctorId','$hospitalId','$remarks','$procedure','$reason','$date',CURRENT_TIMESTAMP())");
    if ($res) {
?>
        <script>
            alert("Notification Sent to The Patient");
            window.location = "../newprescription.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Some Technical Error has Occurred!!");
            window.location = "../dashboard.php";
        </script>
<?php
    }
}

?>