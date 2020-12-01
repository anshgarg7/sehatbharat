<?php
include "dash_common.php";
if (isset($_POST['submit'])) {
    $otId = $_POST['otName'];
    $date = $_POST['date'];
    $prepTime = $_POST['time'];
    $time = getThis("SELECT `otOpeningTime`, `otClosingTime`, `maintenanceTime` FROM `operationtheatre` WHERE `id` = '$otId'");
    $startTime = e_d('d', $time[0]['otOpeningTime']);
    $endTime = e_d('d', $time[0]['otClosingTime']);
    $maintTime = e_d('d', $time[0]['maintenanceTime']);
    $startTime = strtotime($startTime);
    $startTime = strtotime("+" . $maintTime . "hours", $startTime);
    $endTime = strtotime($endTime);
    $today = date('Y-m-d H:i:s');

?>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <form action="functionality/reserveOt.php" method="post">
                <div class="wrap-input100">
                    <div class="position-relative form-group"><label for="exampleCity" class=""><span class="label-input100">
                                <h5>Operation Theatre Timing</h5>
                            </span></label><select class="form-control" name="otTime" id="otTime_c" required>
                            <option selected disabled>Select O.T. Timing</option>
                            <?php
                            $timing = getThis("SELECT `startingTime`, `endingTime` From `otbooking` WHERE `otId` = '$otId' AND `startingTime` > '$today' AND `enabled` = '1'");
                            for ($time = $startTime; strtotime("+" . $prepTime . "hours", $time) <= $endTime; $time = strtotime("+60 minutes", $time)) {
                                $temp_time = date('H:i:s', $time);
                                $temp_startTime = date_create($date . $temp_time);
                                $temp_endTime = date_create($date . $temp_time);
                                date_add($temp_endTime, date_interval_create_from_date_string($prepTime . 'hours'));
                                $temp_startTime = $temp_startTime->format('Y-m-d H:i:s');
                                $temp_endTime = $temp_endTime->format('Y-m-d H:i:s');

                                $flag = 0;
                                for ($i = 0; $i < sizeof($timing); $i++) {
                                    $temp_start = $timing[$i]['startingTime'];
                                    $temp_end = $timing[$i]['endingTime'];
                                    $temp_end = date_create($temp_end);
                                    date_add($temp_end, date_interval_create_from_date_string($maintTime . 'hours'));
                                    $temp_end = $temp_end->format('Y-m-d H:i:s');
                                    if ($temp_startTime >= $temp_start and $temp_startTime < $temp_end) {
                                        $flag = 1;
                                    }
                                    if ($temp_endTime >= $temp_start and $temp_endTime < $temp_end) {
                                        $flag = 1;
                                    }
                                }
                                if ($flag == 0) {
                            ?>
                                    <option value="<?php echo $temp_startTime; ?>"> <?php echo  substr($temp_startTime, 10, 14) . "->" . substr($temp_endTime, 10, 14); ?> </option>
                            <?php
                                }
                            }

                            ?>

                    </div>
                </div>

                <input type="hidden" value="<?php echo $prepTime; ?>" name="prepTime">
                <input type="hidden" value="<?php echo $otId; ?> " name="otId">
                <input type="hidden" value="<?php echo $_SESSION["patientIDforDoctor"]; ?> " name="patientId">
                <br><br>
                <button class="mb-2 mr-2 btn btn-success btn-lg btn-block" name="submit">Submit</button>

            </form>
        </div>
    </div>
<?php
} ?>