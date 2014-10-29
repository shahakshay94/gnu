
<?php
echo "Welcome {$fullname}";
?>
<div class="row">
    <div class="col-lg-3">
    <h3>Companies at campus</h3>
   		<?php foreach ($companies as $data): ?>
		<p><?php echo $data['CompanyMaster']['name']; ?></p>
		<?php endforeach; ?>
    </div>
    <div class="col-lg-3">
    <h3>Companies for training</h3>
 		<?php foreach ($job as $data): ?>
		<p><?php echo $data['CompanyMaster']['name']; ?></p>
		<?php endforeach; ?>
    </div>
    <div class="col-lg-3">
    <h3>Companies for job</h3>
    	<?php foreach ($training as $data): ?>
		<p><?php echo $data['CompanyMaster']['name']; ?></p>
		<?php endforeach; ?>
    </div>
    <div class="col-lg-3">
    <h3>Quick status</h3>
    	<p style="color:#ba373d;"><?php echo "Total companies at campus : ".$total; ?></p>
		<p style="color:#ba373d;"><?php echo "Total companies for job : ".$total_job; ?></p>
		<p style="color:#ba373d;"><?php echo "Total companies for trainig : ".$total_training; ?></p>
		<p style="color:#ba373d;"><?php echo "Companies will hire (Total students)  : ".$total_hiring; ?></p>
    </div>
    </div>
    </div>
</div>
