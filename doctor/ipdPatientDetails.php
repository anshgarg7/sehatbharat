<?php
include "assets/fxn.php";
if (isset($_SESSION["UID"]) == null) {
?>
    <script type="text/javascript">
        window.location = 'index.php';
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

$hospital = getThis("SELECT `hospitalName` FROM `hospitals` WHERE `id`='$hospitalID'");
$hospital = $hospital[0];

$ipdId = $_GET["id"];
$ipdId = e_d('d', $ipdId);

$ipdDetails = getThis("SELECT `patientId`, `doctorId`, `entryTime` FROM `ipdlog` WHERE `id` = '$ipdId'");
$ipdDetails = $ipdDetails[0];
$patientId = $ipdDetails['patientId'];
$patientDetails = getThis("SELECT `id`, `fullName`, `phoneNumber`, `emailAddress`, `previousMedication`, `previousDiseases`, `familyHistory`, `allergicReactions`, `foodHabits`, `insuranceDetails` FROM `patients` WHERE `id`='$patientId'");
$patientDetails = $patientDetails[0];

?>

<head>
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Doctor Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="assets/main.css" rel="stylesheet">
</head>
<script type="text/javascript" src="assets/scripts/main.js"></script>

<body onload="StartTimers();" onmousemove="ResetTimers();">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm mobile-toggle-header-nav" onclick="window.location='logout.php'">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">

                                        <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">

                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $name; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php echo e_d('d', $hospital['hospitalName']); ?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm mobile-toggle-header-nav" onclick="window.location='logout.php'">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboard</li>
                            <li>
                                <a href="dashboard.php" class="mm-active">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Doctor's Dashboard
                                </a>
                            </li>

                    </div>
                </div>

            </div>


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


                    <div class="main-card mb-10 card" style="overflow-x:scroll;">
                        <div class="card-body text-black ">
                            <h3 class="card-title">Personal Details</h3>

                            <table class="mb-0 table table-striped" style='font-size:150%'>

                                <tbody>
                                    <tr>

                                        <td>Name</td>
                                        <td>Patient Name</td>
                                    </tr>
                                    <tr>

                                        <td>Contact Number</td>
                                        <td>123</td>
                                    </tr>
                                    <tr>

                                        <td>Email Address</td>
                                        <td>test</td>
                                    </tr>
                                    <tr>

                                        <td>Previous Diseases</td>
                                        <td>Test disease1, disease2, disease3</td>
                                    </tr>
                                    <tr>

                                        <td>Previous Medication</td>
                                        <td>Test med1, med2, med3</td>
                                    </tr>
                                    <tr>

                                        <td>Food Allergies</td>
                                        <td>None</td>
                                    </tr>
                                    <tr>

                                        <td>Drug Allergy/Side effects</td>
                                        <td>None</td>
                                    </tr>
                                    <tr>

                                        <td>Procedure</td>
                                        <td>test data1, data2, data3</td>
                                    </tr>
                                    <tr>

                                        <td>Remarks</td>
                                        <td>Test data about the patient</td>
                                    </tr>
                                    <tr>

                                        <td><a href="#" class="btn btn-success btn-block">Discharge</a></td>
                                        <td><a href="ipdPres.php" class="btn btn-success btn-block">Update Prescription</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</body>