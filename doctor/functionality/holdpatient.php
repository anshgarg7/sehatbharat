<?php
include "../assets/fxn.php";
if (isset($_SESSION["UID"]) == null) {
?>
    <script type="text/javascript">
        window.location = 'logout.php';
    </script>
<?php
}

$patientId = $_GET['id'];
$patientToken = $_GET['t'];
// $patientToken = e_d('d', $patientToken);
$res = doThis("UPDATE `patienttoken` SET `enabled` = 3 WHERE `token` = '$patientToken'");
if ($res) {
?>
    <script>
        alert("Patient Placed On Hold!!");
        window.location = "../queue.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Some Technical Error!!");
        window.location = "../queue.php";
    </script>
<?php
}
