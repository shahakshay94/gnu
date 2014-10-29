
<div class="table-responsive">
<div class="students view">
<h3><?php echo __('Student Profile'); ?></h3>
<table class="table table-striped">
		<tr><th><?php echo __('Firstname'); ?></th>
		<td>
			<?php echo h($student['Student']['firstname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Lastname'); ?></th>
		<td>
			<?php echo h($student['Student']['lastname']); ?>
			&nbsp;
		</td></tr>
		<tr><th><?php echo __('Institution'); ?></th>
		<td>

			<?php 
			foreach ($institutions as $key => $name) {
					echo $name;
			}
			?>
		</td></tr>
		<tr><th><?php echo __('Department'); ?></th>
		<td>
			<?php 
			foreach ($department_name as $key => $name) {
				echo $name;
			}
			?>
		</td></tr>
		<tr><th><?php echo __('Degree'); ?></th>
		<td>
		<?php 
			foreach ($degrees as $key => $name) {
				echo $name;
			}?>
		</td></tr>
		<tr><th><?php echo __('Email-Id'); ?></th>
		<td>
			<?php 
			foreach ($email as $key => $mail) {
				echo $mail;
			}
			?>
			&nbsp;
		</td></tr>
		
</table>
</div>
