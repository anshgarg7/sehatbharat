<?php
include "../assets/fxn.php";
if (isset($_SESSION["UID"]) == null) {
?>
    <script type="text/javascript">
        window.location = 'logout.php';
    </script>
<?php
}

$ipdId = $_GET['id'];
$ipdId = e_d('d', $ipdId);
$res = doThis("UPDATE `ipdappointment` SET `enabled` = '1' WHERE `id` = '$ipdId' ");
if ($res) {
?>
    <script>
        alert("IPD Date Fixed !!");
        window.location = "../ipdschedule.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Some Technical Error !!");
        window.location = "../ipdschedule.php";
    </script>
<?php
}
?>