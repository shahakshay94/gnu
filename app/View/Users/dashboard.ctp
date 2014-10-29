<br>
<p>
<?php print "Welcome {$fullname}"; ?>
</p>
<p>
<?php print  "Your last login was at ".$this->Time->nice($modified); ?>
</p>
<p>
<?php if(Auth::user('student_id')){ 
                    echo $this->Html->link(__("View Profile"),[
                    'plugin'=>false,
                    'controller' => 'students',
                    'action' => 'view',
                    AuthComponent::user('student_id')]); }
?>
</p>
<p>
<?php
echo $this->Html->link(
    $this->Html->image('support-ticket.png', ['alt' => 'support-ticket']),
    [
        'plugin' => 'support_ticket_system',
        'controller' => 'pages',
        'action' => 'dashboard',
    ],['escape' => false]
);
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if (Auth::hasRoles(array('tpadmin'))) {
echo $this->Html->link(
    $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
        'plugin' => 'training_and_placement',
        'controller' => 'company_campuses',
        'action' => 'home',
    ],['escape' => false]
);
} else {
  echo $this->Html->link(
    $this->Html->image('placement.gif', ['alt' => 'training_and_placement']),
    [
        'plugin' => 'training_and_placement',
        'controller' => 'placement_results',
        'action' => 'student_home',
    ],['escape' => false]
);  
}
?>
</p>
