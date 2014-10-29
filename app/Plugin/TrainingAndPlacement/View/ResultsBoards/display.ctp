<div class="resultsBoards view">
<table class="table table-striped">
	<?php foreach ($resultsBoards as $resultsBoard): ?>
		<?php if($resultsBoard['ResultsBoard']['exam_type'] == 'SSC'){?>
		<h3><?php echo __('Result of SSC'); ?></h3>
		<tr>
		<th><?php echo __('Board'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['board_name']); ?>

		</td>
	</tr>
	<tr>	
		<th><?php echo __('Passing Year'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['passing_year']); ?>
			
		</td>
		</tr>
	<tr>	
		<th><?php echo __('Percentages'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['percentage']); ?>
		
		</td>
	</tr>
	<?php } ?>
	<?php endforeach; ?>
	</table>

<table class="table table-striped">
	<?php foreach ($resultsBoards as $resultsBoard): ?>
		<?php if($resultsBoard['ResultsBoard']['exam_type'] == 'HSC'){?>
		<h3><?php echo __('Result of HSC'); ?></h3>
	<tr>
		<th><?php echo __('Board'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['board_name']); ?>
		
		</td>
	</tr>
	<tr>
		<th><?php echo __('Passing Year'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['passing_year']); ?>
	
		</td>
	</tr>
	<tr>
		<th><?php echo __('Percentages'); ?></th>
		<td>
			<?php echo h($resultsBoard['ResultsBoard']['percentage']); ?>

		</td>
	</tr>
	<?php } ?>
	<?php endforeach; ?>
	</table>
	</div>