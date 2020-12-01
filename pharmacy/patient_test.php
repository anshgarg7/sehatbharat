<?php include "dash_common.php"; ?>
<div class="app-main__outer">
    <div class="app-main__inner">
<?php
  if(isset($_POST['submit']))
  {
    $username = $_POST['username'];
    $username = e_d('e',$username);
    $patientID = getThis("SELECT `id` FROM `patients` WHERE `username` = '$username'");
    $patientID = $patientID[0]['id'];
    $temp_medicine = getThis("SELECT `doctorID`, `medicinePrescribed`, `medicineDosage`, `medicineInstructions`, `days` FROM `prescription` WHERE `patientID` = '$patientID' ORDER BY `generatedAt` DESC");
    // $medicine = $medicine[0];
    $count = 0;
?>
<div class="col-lg-12">
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Latest Prescriptions</h5>
            <table class="mb-0 table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Medicine Name</th>
                    <th>Dosage</th>
                    <th>Instructions</th>
                    <th>Follow Up Days</th>
                    <th>Prescribed By</th>

                </tr>
                </thead>
                <tbody>
                  <?php
                      for($i=0;$i<sizeof($temp_medicine);$i++){
                        $medicine = $temp_medicine[$i];
                   ?>
                <tr>
                  <td>
                      <?php  $count++;
                      echo $count;  ?>
                  </td>
                  <td>
                  <?php
                  $med_name = $medicine['medicinePrescribed'];

                  if(isset($med_name)!=NULL)
                  {
                    $med_name = unserialize(e_d('d',$med_name));
                    for($x=0;$x<sizeof($med_name);$x++)
                    {
                      echo $med_name[$x]."<br>";
                    }
                  }


                  ?>
                  </td>
                  <td>
                    <?php
                      $dose = $medicine['medicineDosage'];
                      if(isset($dose)!=NULL)
                      {
                        $dose = unserialize(e_d('d',$dose));
                        for($y=0;$y<sizeof($dose);$y++)
                        {
                          echo $dose[$y]."<br>";
                        }
                      }
                     ?>
                  </td>
                  <td>
                    <?php
                      $instruction = $medicine['medicineInstructions'];
                      if(isset($instruction)!=NULL)
                      {
                        $instruction = unserialize(e_d('d',$instruction));
                        for($z=0;$z<sizeof($instruction);$z++)
                        {
                          echo $instruction[$z]."<br>";
                        }
                      }
                     ?>
                  </td>
                  <td>
                    <?php echo $medicine['days']; ?>
                  </td>
                  <td>
                    <?php
                      $docId = $medicine['doctorID'];
                      $docName = getThis("SELECT `fullName` FROM `doctors` WHERE `id` = '$docId'");
                      $docName = $docName[0]['fullName'];
                      $docName = e_d('d',$docName);
                      echo $docName;
                     ?>
                  </td>
                </tr>
              <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } ?>

</div>
</div>
</body>
</html>
