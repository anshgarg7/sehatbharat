<?php
include "../assets/fxn.php";
$id = $_GET["id"];
$id = e_d('d', $id);
$res = doThis("UPDATE `ipdrounds` SET `enabled` = '0' WHERE `id` = '$id'");
if ($res) {
?>
    <script>
        alert("IPD Round Completed!!");
        window.location = "../logout.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!!");
        window.location = "../ipdDash.php";
    </script>
<?php
}
?>