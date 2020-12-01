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
        <form action="functionality/leaveApply.php" method="post">
           
            <h3>Leave From</h3>
            <input type="date" name="leavefrom" required>
            <h3>Leave To</h3>
            <input type="date" name="leaveto" required>
            <br>
            <br>
            <br>
            <button type="submit" name="submit" class="mb-2 mr-2 btn btn-primary btn-lg btn-block">Submit</button>
        </form>
    </div>
</div>    