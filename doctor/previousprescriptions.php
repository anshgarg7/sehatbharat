<?php
include "assets/fxn.php";
if(isset($_SESSION["UID"])==null){
	?>
	<script type="text/javascript">
		window.location='logout.php';
	</script>
	<?php
}
$id = $_SESSION["UID"];
$name = e_d('d',$_SESSION["fullName"]);
$email = e_d('d',$_SESSION["emailAddress"]);
$phone = e_d('d',$_SESSION["phoneNumber"]);
$departmentID = $_SESSION["departmentID"];
$qualificationID = $_SESSION["qualificationID"];
$hospitalID = $_SESSION["hospitalID"];
$pid = $_SESSION["patientIDforDoctor"];
$patientID = e_d('d',$_SESSION["patientIDforDoctor"]);
$token = $_SESSION['patienttoken'];
$details = getThis("SELECT  `fullName`, `phoneNumber`, `emailAddress`,`previousMedication`, `previousDiseases` FROM `patients` WHERE `id` = '$patientID'");
$details = $details[0];
$selectedData = getThis("SELECT `prescriptionView`, `laboratoryReportsView` FROM `patienttoken` WHERE `token`='$token'");
$selectedData = $selectedData[0];
$prescriptionSelected = e_d('d',$selectedData['prescriptionView']);
$prescriptionSelected = unserialize($prescriptionSelected);
$reportsSelected = e_d('d',$selectedData['laboratoryReportsView']);
$reportsSelected = unserialize($reportsSelected);
$previousprescriptions = getThis("SELECT `id`,`symptoms`,`medicinePrescribed`, `generatedAt`, `updatedAt` FROM `prescription` WHERE `patientID`='$patientID' AND `doctorID`='$id' ORDER BY `generatedAt` DESC");
$allprescriptions = getThis("SELECT prescription.`id` AS prescriptionid,`symptoms`,`medicinePrescribed`, `generatedAt`, `updatedAt`,doctors.`fullName` AS doctorName FROM `prescription`,`doctors` WHERE `patientID`='$patientID' AND prescription.`doctorID`=doctors.`id` ORDER BY `generatedAt` DESC");
$hospital = getThis("SELECT `hospitalName` FROM `hospitals` WHERE `id`='$hospitalID'");
$hospital = $hospital[0];

?>
<!doctype html>
<html lang="en">
<?php include "patient_dash_common.php"; ?>
                <!-- form area starts -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">

                                    <div>Patient <?php echo e_d('d',$details['fullName']); ?>
                                    </div>
                                </div>
                               </div>
                        </div>
                        <div class="row">
                          <?php if($prescriptionSelected!=null){
													if(sizeof($prescriptionSelected)>0){ ?>
													<div class="col-md-12">
														<div class="main-card mb-3 card"   style="overflow-x:scroll;">
																<div class="card-body"><h5 class="card-title">Previous Prescriptions By Myself</h5>
																		<table class="mb-0 table table-striped">
																				<thead>
																				<tr>
																						<th>#</th>
																						<th>Symptoms</th>
																						<th>Medication</th>
																						<th>Prescription Date</th>
																						<th>Update Date</th>
																						<th>Action</th>
																				</tr>
																				</thead>
																				<tbody>
																					<?php
																					for ($j=0; $j < sizeof($prescriptionSelected); $j++) {
																						$prescript = $prescriptionSelected[$j];
																						$result = getThis("SELECT `id`,`symptoms`,`medicinePrescribed`, `generatedAt`, `updatedAt` FROM `prescription` WHERE `id`='$prescript' AND `patientID`='$patientID' AND `doctorID`='$id' ORDER BY `generatedAt` DESC");
																						if(sizeof($result)>0){
																						$result = $result[0];
																					?>
																				<tr>
																						<th>#</th>
																						<td>
																							<?php
																							$symptoms = e_d('d',$result['symptoms']);
		                                          $symptoms = unserialize($symptoms);
		                                          for($i=0;$i<sizeof($symptoms);$i++)
		                                          {
																								echo $symptoms[$i];
																								echo "<br>";
																							} ?>
																						</td>
																						<td>
																							<?php
																							$medicine = e_d('d',$result['medicinePrescribed']);
		                                          $medicine = unserialize($medicine);
		                                          for($i=0;$i<sizeof($medicine);$i++)
		                                          {
																								echo $medicine[$i];
																								echo "<br>";
																							} ?>
																						</td>
																						<?php $date = date('<b>d M</b> Y <b>h.i.s A</b>',strtotime($result['generatedAt'])); ?>
																						<td><?php echo $date; ?></td>
																						<td><?php if($result['updatedAt']!=null){
																							$date1 = date('<b>d M</b> Y <b>h.i.s A</b>',strtotime($result['updatedAt']));
																							echo $date1;
																							}else{
																								echo "Not Updated";
																							} ?>
																						</td>
																						<td>
																							<a class="mb-2 mr-2 btn btn-primary" id="<?php echo $result['id'];?>" href="prescription_update.php?id=<?php echo e_d('e',$result['id']); ?>">Update</a>
																						</td>
																				</tr>
																			<?php }}?>
																				</tbody>
																		</table>

																</div>
														</div>
													</div>
												<?php }} ?>
												<?php if($prescriptionSelected!=null){
												 if(sizeof($prescriptionSelected)>0){ ?>
                        <div class="col-md-12">
                          <div class="main-card mb-3 card"   style="overflow-x:scroll;">
                              <div class="card-body"><h5 class="card-title">All Previous Prescriptions</h5>
                                  <table class="mb-0 table table-striped">
                                      <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Symptoms</th>
                                          <th>Medication</th>
                                          <th>Prescription Date</th>
                                          <th>Prescribed By</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <?php

																				for ($j=0; $j < sizeof($prescriptionSelected); $j++) {
																					$prescript = $prescriptionSelected[$j];
																					$result = getThis("SELECT prescription.`id` AS prescriptionid,`symptoms`,`medicinePrescribed`, `generatedAt`, `updatedAt`,doctors.`fullName` AS doctorName FROM `prescription`,`doctors` WHERE prescription.`id`='$prescript' AND `patientID`='$patientID' AND prescription.`doctorID`=doctors.`id` ORDER BY `generatedAt` DESC");
																					if(sizeof($result)>0){
																					$result = $result[0];

                                        ?>
                                      <tr>
                                          <th>#</th>
                                          <td>
                                            <?php
                                            $symptoms = e_d('d',$result['symptoms']);
                                            $symptoms = unserialize($symptoms);
                                            for($i=0;$i<sizeof($symptoms);$i++)
                                            {
                                              echo $symptoms[$i];
                                              echo "<br>";
                                            } ?>
                                          </td>
                                          <td>
                                            <?php
                                            $medicine = e_d('d',$result['medicinePrescribed']);
                                            $medicine = unserialize($medicine);
                                            for($i=0;$i<sizeof($medicine);$i++)
                                            {
                                              echo $medicine[$i];
                                              echo "<br>";
                                            } ?>
                                          </td>
																					<?php $date1 = date('<b>d M</b> Y <b>h.i.s A</b>',strtotime($result['generatedAt'])); ?>
																					<td><?php echo $date1; ?></td>
                                          <td>
                                            <?php echo e_d('d',$result['doctorName']); ?>
                                          </td>
                                          <td>
                                            <a class="mb-2 mr-2 btn btn-primary" id="<?php echo $result['prescriptionid'];?>" href="viewprescription.php?id=<?php echo e_d('e',$result['prescriptionid']); ?>">View</a>
                                          </td>
                                      </tr>
                                    <?php }} ?>
                                      </tbody>
                                  </table>

                              </div>
                          </div>
                        </div>
											<?php }}else{ ?>
												<div class="col-md-12 col-xl-12">
														<div class="card mb-3 widget-content bg-grow-early">
															<div class="card-body"><h5 class="card-title" style="color:white;"></h5>
																					<h2>NO PRESCPTION PRESCRIBED YET</h2>
																					</div>
													</div>
													</div>
											<?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>




</body>
</html>
