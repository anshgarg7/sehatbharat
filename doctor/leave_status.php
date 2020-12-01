<?php include "dash_common.php"; ?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="main-card mb-3 card" style="overflow-x:scroll;">
            <div class="card-body">
                <h5 class="card-title">Leave Applications</h5>
                <table class="mb-0 table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Leave Requested On</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    $result = getThis("SELECT `leaveFrom`,`leaveTo`,`generatedAt`,`enabled` FROM `doctorLeaves` WHERE `doctorID` = '$id'");
                    ?>
                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($result); $i++) {
                            $temp = $result[$i];
                        ?>
                            <tr>
                                <td>
                                    <?php echo $i + 1; ?>
                                </td>
                                <td>
                                    <?php echo substr($temp['generatedAt'], 0, 10); ?>
                                </td>
                                <td>
                                    <?php echo substr($temp['leaveFrom'], 0, 10); ?>
                                </td>
                                <td>
                                    <?php echo substr($temp['leaveTo'], 0, 10); ?>
                                </td>
                                <td>
                                    <?php $status =  $temp['enabled'];
                                    if ($status == 0) {
                                        echo "Under Review";
                                    } else if ($status == 1) {
                                        echo "Approved";
                                    } else {
                                        echo "Rejected";
                                    }

                                    ?>
                                </td>
                            </tr>
                    </tbody>
                <?php
                        } ?>
                </table>
            </div>
        </div>
    </div>
</div>