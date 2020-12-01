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
$pid = $_SESSION["patientIDforDoctor"];
$token = $_SESSION['patienttoken'];
$patientID = e_d('d', $_SESSION["patientIDforDoctor"]);
$details = getThis("SELECT  `fullName`, `phoneNumber`, `emailAddress`,`previousMedication`, `previousDiseases` FROM `patients` WHERE `id` = '$patientID'");
$details = $details[0];
$selectedData = getThis("SELECT `prescriptionView`, `laboratoryReportsView` FROM `patienttoken` WHERE `token`='$token'");
$selectedData = $selectedData[0];
$prescriptionSelected = e_d('d', $selectedData['prescriptionView']);
$prescriptionSelected = unserialize($prescriptionSelected);
$reportsSelected = e_d('d', $selectedData['laboratoryReportsView']);
$reportsSelected = unserialize($reportsSelected);
$previousprescriptions = getThis("SELECT `id`,`symptoms`,`medicinePrescribed`, `generatedAt`, `updatedAt` FROM `prescription` WHERE `patientID`='$patientID' AND `doctorID`='$id' ORDER BY `generatedAt` DESC");
$hospital = getThis("SELECT `hospitalName` FROM `hospitals` WHERE `id`='$hospitalID'");
$hospital = $hospital[0];

if (isset($_POST['submit'])) {
    $room = $_POST['room'];
    $bed = $_POST['bed'];
    // $temp_res = doThis("UPDATE `beds` set `enabled` = '1' WHERE `id` = '$bed'");
    $res = doThis("INSERT INTO `ipdlog`(`patientId`, `doctorId`, `hospitalId`,`bedId`, `entryTime`) VALUES ('$patientID','$id','$hospitalID', '$bed' ,CURRENT_TIMESTAMP())");
    $temp_res = doThis("UPDATE `beds` set `enabled` = '1', `currIpdId` = '$res' WHERE `id` = '$bed' ");
    if ($res and $temp_res) {
    ?>
        <script>
            alert("Patient Admitted!!");
            window.location = "../newprescription.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Some Technical Error!!");
            window.location = "../newprescription.php";
        </script>
<?php
    }
}
?>


?>