<?php
echo "Welcome {$fullname}";
?>
<div class="placementResults view">
<div class="row">
    <div class="col-lg-3">
    <h3>Your applied Companies</h3>
    <?php foreach ($data as $a): ?>
		<p><?php echo $a['CompanyCampus']['CompanyMaster']['name']; ?>		
		</p>
<?php endforeach; ?>
    </div>
    <div class="col-lg-3">
    <h3>Companies at campus</h3>
    <?php foreach ($companies as $a): ?>
		<p><?php echo $a['CompanyMaster']['name']; ?>		
		</p>
<?php endforeach; ?>
    </div>
    <div class="col-lg-3">
    <h3>Companies for training</h3>
    <?php foreach ($training as $a): ?>
		<p><?php echo $a['CompanyMaster']['name']; ?>		
		</p>
<?php endforeach; ?>
    </div>
	<div class="col-lg-3">
    <h3>Companies for job</h3>
    <?php foreach ($job as $a): ?>
		<p><?php echo $a['CompanyMaster']['name']; ?>		
		</p>
<?php endforeach; ?>
    </div>



</div>