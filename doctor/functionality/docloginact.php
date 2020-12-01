<?php
include "../assets/fxn.php";
$user = e_d('e', $_POST["username"]);
$pass = e_d('e', $_POST["password"]);
$token = $_POST["token"];
$login = getThis("SELECT doctors.`id` AS id,doctoken.`id` AS tid,doctoken.`token` AS token, doctors.`hospitalID`,doctors.`qualificationID`,doctors.`departmentID`, doctors.`fullName`, doctors.`phoneNumber`, doctors.`emailAddress`,doctors.`currentActivity` FROM `doctors`,`doctoken` WHERE `username`='$user' AND `password`='$pass' AND doctors.`enabled`=1 AND doctoken.`enabled` = 1 AND doctoken.`token` = '$token' AND doctors.`tokenID` = doctoken.`id`");
//$temp_login = $con->query("SELECT doctors.`id` AS id,`hospitalID`,`qualificationID`,`departmentID`, `fullName`, `phoneNumber`, `emailAddress` FROM `doctors` WHERE `username`='$user'   AND `password`='$pass' AND doctors.`enabled`=1");
if ($login) {
	$login = $login[0];

	if ($login["id"] != null) {
		$id = $login["id"];
		$tid = $login["tid"];
		$_SESSION["UID"] = $login["id"];
		$_SESSION["fullName"] = $login["fullName"];
		$_SESSION["emailAddress"] = $login["emailAddress"];
		$_SESSION["phoneNumber"] = $login["phoneNumber"];
		$_SESSION["hospitalID"] = $login["hospitalID"];
		$_SESSION["qualificationID"] = $login["qualificationID"];
		$_SESSION["departmentID"] = $login["departmentID"];
		$_SESSION["token"] = $login["token"];
		doThis("UPDATE `doctoken` SET `lastLoginAt`=CURRENT_TIMESTAMP() WHERE `id` = '$tid'");

		if ($login["currentActivity"] == '0') {
			doThis("UPDATE `doctors` SET `lastLogin`=CURRENT_TIMESTAMP(), `currentActivity` = '1' WHERE `id` = '$id'");

?>
			<script type="text/javascript">
				window.location = '../index.php';
			</script>
		<?php
		} else if ($login["currentActivity"] == '2') {
		?>
			<script>
				window.location = "../ipdDash.php";
			</script>
		<?php
		}
	} else {
		?>
		<script type="text/javascript">
			alert("Login Failed ! Please try again !!");
			window.location = '../index.php';
		</script>
<?php
	}
} else {
	?>
<script type="text/javascript">
	alert("Login Failed ! Please try again !!");
	window.location = '../index.php';
</script>
<?php } ?>
