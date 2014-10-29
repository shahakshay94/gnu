<div class="companycampus index">
	<h3><?php
echo __('Search Result');
?></h3>
	<p style="text-transform:uppercase;"><b>Campus Info : </b>
	<?php
foreach ($info_institute as $a) {
    echo $a['Institution']['name'] . ' >> ';
}

foreach ($info_branch as $b) {
    echo $b['Department']['name'] . ' >> ';
}

foreach ($info_degree as $c) {
    echo $c['Degree']['name'] . ' >> ';
}

foreach ($info_academic_year as $d) {
    echo $d['AcademicYear']['name'];
}

?></p>
	<?php

if ($total == 0) {
    echo '<h2>No such result found</h2>';
} else {
?>	
	<p style="text-transform:uppercase;">
	<?php
    echo '<b>Total companies at campus : </b>' . $total;
    echo '<br><br><b>Total no. of students applied for these companies : </b>' . $stu_list;
?><br><br>	
	<?php
    echo '<b>Compnies will hire/total hiring : </b>' . $total_hiring;
?><br><br>
	<?php
    echo '<b>Appointed from total hiring : </b>' . $appointed_list;
?><br><br>
	<?php
    echo '<b>Pending students : </b>' . $pending_list;
?><br><br>
	<?php
    echo '<b>Still Not qualified students : </b>' . $notqualified_list;
?></p><br><br>
	<table cellpadding="0" cellspacing="0" class="table table-striped">
	<tr>
			<th><?php
    echo 'List of companies';
?></th>
			<th><?php
    echo 'Actions';
?></th>
	</tr>
	<?php
    foreach ($data as $companyCampus):
?>		
	<tr>
		<td>
<?php
        echo $this->Html->link(__($companyCampus['CompanyMaster']['name']), array(
            'controller' => 'company_masters',
            'action' => 'view',
            $companyCampus['CompanyMaster']['id']
        ));
?></td>
<td class="actions"><?php
        echo $this->Html->link(__('Applied Students'), array(
            'controller' => 'placement_results',
            'action' => 'student_list',
            $institute,
            $departments,
            $degrees,
            $companyCampus['CompanyMaster']['id']
        ));
?> | <?php
        echo $this->Html->link(__('Appointed Students'), array(
            'controller' => 'placement_results',
            'action' => 'appointed_status',
            $institute,
            $departments,
            $degrees,
            $companyCampus['CompanyMaster']['id']
        ));
?> | <?php
        echo $this->Html->link(__('Not qualified Students'), array(
            'controller' => 'placement_results',
            'action' => 'notqualified_status',
            $institute,
            $departments,
            $degrees,
            $companyCampus['CompanyMaster']['id']
        ));
?> | <?php
        echo $this->Html->link(__('Pending Students'), array(
            'controller' => 'placement_results',
            'action' => 'pending_status',
            $institute,
            $departments,
            $degrees,
            $companyCampus['CompanyMaster']['id']
        ));
?></td>
	</tr>
<?php
    endforeach;
?>
	</table>
	<?php
}
?>
</div>