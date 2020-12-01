<?php
include "../assets/fxn.php";
if(isset($_POST["submit"])){
$question = $_POST['question'];
$doctorID = $_POST['doctorID'];
$question = e_d('e',$question);
$res = doThis("INSERT INTO `discussion`(`doctorID`, `question`, `askedAt`) VALUES('$doctorID','$question',CURRENT_TIMESTAMP())");

if($res)
{
  ?>
  <script>
  alert("Question Asked Successfully !!");
  window.location = "../discussion.php";
  </script>
  <?php
}
else {
  ?>
  <script>
alert("There Is Some Technical Error! Please Try After Sometime");
  window.location = "../discussion.php";
  </script>
<?php
}
}
 ?>
