<?php include "dash_common.php"; ?>
<?php
// $id = $_SESSION["UID"];
// $name = e_d('d',$_SESSION["fullName"]);
// $email = e_d('d',$_SESSION["emailAddress"]);
// $phone = e_d('d',$_SESSION["phoneNumber"]);
// $departmentID = $_SESSION["departmentID"];
// $qualificationID = $_SESSION["qualificationID"];
// $hospitalID = $_SESSION["hospitalID"];

$hospital = getThis("SELECT `hospitalName` FROM `hospitals` WHERE `id`='$hospitalID'");
$hospital = $hospital[0];

?>
<!doctype html>
<html lang="en">



<!-- form area starts -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">

                    <div><?php echo $name; ?>'s Dashboard
                        <div class="page-title-subheading">Welcome to Your DashBoard Doctor!!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Patients</div>
                        </div>
                        <div class="widget-content-right">
                            <?php
                            $totalpatientcount = getThis("SELECT COUNT(DISTINCT `patientID`) AS tpc FROM `prescription` WHERE `doctorID` = '$id'");
                            $totalpatientcount = $totalpatientcount[0]['tpc'];
                            ?>
                            <div class="widget-numbers text-white"><span><?php echo $totalpatientcount; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="functionality/ipdInspectAct.php" class="mb-2 mr-2 btn btn-primary btn-lg btn-block"> Go For IPD Inspection</a>
        <a href="functionality/surgeryAct.php" class="mb-2 mr-2 btn btn-primary btn-lg btn-block">Go For Scheduled Surgery</a>
    </div>
</div>
</div>
</div>




</body>

</html>