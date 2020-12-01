<?php
include "dash_common.php";
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">

                    <div><?php echo $name; ?>'s Dashboard
                        <div class="page-title-subheading">Welcome to Your DashBoard!!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="otTime.php" method="post">
            <div class="wrap-input100">
                <div class="position-relative form-group"><label for="exampleCity" class=""><span class="label-input100">
                            <h5>Operation Theatre</h5>
                        </span></label><select class="form-control" name="otName" id="otName_c" required>
                        <option selected disabled>Select O.T.</option>
                        <?php $ot = getThis("SELECT `id`, `otName` FROM `operationtheatre` WHERE `hospitalId` = '$hospitalID'"); ?>
                        <?php foreach ($ot as $k => $c) { ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo e_d('d', $c['otName']); ?></option>
                        <?php } ?>
                    </select></div>
                <div class="col-md-12">
                    <div class="position-relative form-group"><label for="exampleEmail11" class="">
                            <h5>Date Of Procedure</h5>
                        </label><input name="date" type="date" class="form-control"></div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative form-group"><label for="exampleEmail11" class="">
                            <h5>Procedure Time, Including Prep Time (in Hrs) </h5>
                        </label><input name="time" type="number" class="form-control"></div>
                </div>
                <button class="mb-2 mr-2 btn btn-primary btn-lg btn-block" type="submit" name="submit">Select Timing</button>
            </div>

        </form>
    </div>
</div>
</body>

</html>