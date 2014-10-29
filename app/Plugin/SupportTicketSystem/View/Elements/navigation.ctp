<?php echo $this->Html->css('navigation'); ?>
<br>
<div class="navbar navbar-default navbar-static-top" style="background-color:#fff">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
             <p style="padding-left: 20px;">   <?php echo $this->Html->image('gnulogo.png', array('alt' => 'GNU', 'border' => '0')); ?></p>
             </div>
        <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
        <li><?php echo $this->Html->link(__("Home"),array('plugin'=>false,'controller' => 'users', 'action' => 'dashboard')) ?></li>
        <li><?php echo $this->Html->link(__("Dashboard"),array('plugin'=>'support_ticket_system','controller' => 'pages', 'action' => 'dashboard')) ?></li>
        <li class="dropdown menu-large">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support Ticket<b class="caret"></b></a>				
        <ul class="dropdown-menu megamenu row">
        <li class="col-sm-3">
        <ul>
          <?php if(Auth::hasRoles(['developer'])) {?>

          <li class="dropdown-header">Categories</li>
          <li><?php echo $this->Html->link(__("New Category",true),array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'add_developer')) ?></li>
          
          <?php } ?>

          <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
          
          <li class="dropdown-header">Categories</li>
          <li><?php echo $this->Html->link(__("New Category",true),array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'add')) ?></li>
          
          <?php } ?>

          <?php if(Auth::hasRoles(['developer'])) {?>
          
          <li><?php echo $this->Html->link(__("View Category",true),array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'index_developer'))  ?></li>
          <li class="divider"></li>
          
          <?php } ?>

          <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
          <li><?php echo $this->Html->link(__("View Category",true),array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'index'))  ?></li>
          <li class="divider"></li>
          <?php } ?>

          <?php if(Auth::hasRoles(['deptcoordinator'])) {?>
          <li><?php echo $this->Html->link(__("View Category",true),array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'index_deptcoord'))  ?></li>
          <li class="divider"></li>
          <?php } ?>

          <li class="dropdown-header">Ticket</li>
          <li><?php echo $this->Html->link(__("New Ticket"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'add')) ?></li>
          <li><?php echo $this->Html->link(__("View Tickets"), array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'index'))?></li>
          <li><?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin','developer'])) { echo $this->Html->link(__("Manage Tickets"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'manage_tickets')); } ?></li>
          <li><?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) { echo $this->Html->link(__("View all tickets"), array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'adminindex')); }?></li>
          
          </ul>
          </li>
          <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) {?>
          <li class="col-sm-3">
          <ul>
          <li class="dropdown-header">Status</li>
          <li><?php echo $this->Html->link(__("New Status"),array('plugin'=>'support_ticket_system','controller' => 'statuses', 'action' => 'add')) ?></li>
          <li><?php echo $this->Html->link(__("View Status"),array('plugin'=>'support_ticket_system','controller' => 'statuses', 'action' => 'index')) ?></li>
          <li class="divider"></li>
          <?php } ?>


          <?php if(Auth::hasRoles(['developer'])) {?>
          <li class="dropdown-header">Manage Coordinators</li>
          <li><?php echo $this->Html->link(__("New Coordinator",true),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'add_developer')) ?></li>
          <li><?php echo $this->Html->link(__("View Coordinators"),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'index_developer')) ?></li>                     
          </ul>
          </li>
          <?php } ?>

          <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
          <li class="dropdown-header">Manage Coordinators</li>
          <li><?php echo $this->Html->link(__("New Coordinator",true),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'add')) ?></li>
          <li><?php echo $this->Html->link(__("View Coordinators"),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'index')) ?></li>                     
          </ul>
          </li>
          <?php } ?>

          <?php if(Auth::hasRoles(['deptcoordinator'])) {?>
          <li class="dropdown-header">Manage Coordinators</li>
          <li><?php echo $this->Html->link(__("New Coordinator",true),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'add_deptcoord')) ?></li>
          <li><?php echo $this->Html->link(__("View Coordinators"),array('plugin'=>'support_ticket_system','controller' => 'ticket_manages', 'action' => 'index_deptcoord')) ?></li>                     
          </ul>


          </li>
          <?php } ?>

          <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) {?>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Reports</li>
							 <li><?php echo $this->Html->link(__("Column Charts"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'column_tickets')) ?></li>
                			<li><?php echo $this->Html->link(__("Pie Chart"),array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'pie_tickets')) ?></li>
           <li class="divider"></li>
                      <li class="dropdown-header">View</li>
          
              <li><?php if(Auth::user('student_id')) { echo $this->Html->link(__("View Profile"),array('plugin'=>'support_ticket_system','controller' => 'students', 'action' => 'view', AuthComponent::user('student_id'))); } ?></li>
                      <li><?php if(Auth::user('staff_id')) { echo $this->Html->link(__("View Profile"),array('plugin'=>'support_ticket_system','controller' => 'staffs', 'action' => 'view', AuthComponent::user('staff_id'))); } ?></li>
              <li><?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) { echo $this->Html->link(__("Settings"),array('plugin'=>'support_ticket_system','controller' => 'settings', 'action' => 'index')); } ?></li>
              <?php } ?>			
						</ul>

					</li>
            
				</ul>
				
			</li>
      <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) {?>
        <li><?php echo $this->Html->link(__("Logout",true),array('controller' => 'users' ,'action'=>'logout' ,'plugin'=>false)) ?></li> 
        <?php } ?>
		</ul>
		</div>
      </div>
    </div>