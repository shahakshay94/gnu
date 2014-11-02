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
        <h3 style="padding-left:200px;">Support Ticket System Module</h3>
        <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li>
              <?php echo $this->Html->link(__("Home"),[
              'plugin'=>false,
              'controller' => 'users', 
              'action' => 'dashboard']); ?>
            </li>

            <li><?php echo $this->Html->link(__("Dashboard"),[
            'plugin'=>'support_ticket_system',
            'controller' => 'pages', 
            'action' => 'dashboard']); ?>
            </li>

            <li class="dropdown menu-large">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support Ticket<b class="caret"></b></a>				
            <ul class="dropdown-menu megamenu row">
            <li class="col-sm-2">
              <ul>
<!-- Categories dropdown starts from here -->
                  <?php if(Auth::hasRoles(['superadmin','stadmin','developer','deptcoordinator'])) {?>
                   <li class="dropdown-header">Categories</li>
                  <?php } ?>

                  <?php if(Auth::hasRoles(['developer'])) {?>         
                    <li>
                      <?php echo $this->Html->link(__("New Category",true),[
                      'plugin'=>'support_ticket_system',
                      'controller' => 'categories', 
                      'action' => 'add_developer']); ?>
                    </li>          
                    <?php } ?>

                  <?php if(Auth::hasRoles(['superadmin','stadmin','deptcoordinator'])) {?>          
                    <li>
                      <?php echo $this->Html->link(__("New Category",true),[
                      'plugin'=>'support_ticket_system',
                      'controller' => 'categories',
                       'action' => 'add']); ?>
                     </li>          
                    <?php } ?>

                  <?php if(Auth::hasRoles(['developer'])) {?>          
                  <li>
                    <?php echo $this->Html->link(__("View Category",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'categories',
                    'action' => 'index_developer']); ?>
                  </li>
                  <li class="divider"></li>          
                  <?php } ?>

                  <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
                  <li>
                    <?php echo $this->Html->link(__("View Category",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'categories',
                    'action' => 'index']);  ?>
                  </li>
                  <li class="divider"></li>
                  <?php } ?>

                  <?php if(Auth::hasRoles(['deptcoordinator'])) {?>
                  <li>
                    <?php echo $this->Html->link(__("View Category",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'categories',
                    'action' => 'index_deptcoord']); ?></li>
                  <li class="divider"></li>
                  <?php } ?>
        <!-- Categories dropdown ends here -->

        <!-- Tickets dropdown starts from here -->

                  <li class="dropdown-header">Ticket</li>

                  <li>
                    <?php if(!Auth::hasRoles(['developer'])) {
                    echo $this->Html->link(__("New Ticket"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'tickets', 
                    'action' => 'add']); } ?>
                  </li>

                  <li>
                    <?php if(!Auth::hasRoles(['developer'])) {
                      echo $this->Html->link(__("View Tickets"),[
                     'plugin'=>'support_ticket_system',
                     'controller' => 'tickets', 
                     'action' => 'index']); } ?>
                   </li>

                  <li>
                    <?php if(Auth::hasRoles(['stadmin','stcoordinator','superadmin'])) { 
                      echo $this->Html->link(__("Manage Tickets"),[
                      'plugin'=>'support_ticket_system',
                      'controller' => 'tickets',
                       'action' => 'manage_tickets']); } ?>
                    </li>

                    <li>
                    <?php if(Auth::hasRoles(['stcoordinator'])) { 
                      echo $this->Html->link(__("Manage Transferred Tickets"),[
                      'plugin'=>'support_ticket_system',
                      'controller' => 'department_transfers',
                       'action' => 'manage_transferred_tickets']); } ?>
                    </li>

                  <li>
                    <?php if(Auth::hasRoles(['developer'])) {
                     echo $this->Html->link(__("View all tickets"),[
                      'plugin'=>'support_ticket_system',
                      'controller' => 'tickets', 
                      'action' => 'adminindex']); }?>
                  </li>          
              </ul>
            </li>
<!-- Tickets dropdown ends  here -->

<!-- Statuses dropdown starts from here -->
            <li class="col-sm-2">
              <ul>
                  <?php if(Auth::hasRoles(['superadmin','stadmin','developer'])) {?>
                  <li class="dropdown-header">Status</li>
                  <?php } ?>

                  <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) {?>
                  <li>
                    <?php echo $this->Html->link(__("New Status"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'statuses',
                    'action' => 'add']); ?>
                   </li>
                  <li>
                    <?php echo $this->Html->link(__("View Status"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'statuses',
                    'action' => 'index']); ?>
                  </li>
                  <li class="divider"></li>
                  <?php } ?>
      <!-- Statuses dropdown ends  here -->
      <!-- Coordinators/Staffs dropdown starts from here -->                  
                  <?php if(Auth::hasRoles(['superadmin','stadmin','developer','deptcoordinator'])) {?>
                  <li class="dropdown-header">Manage Coordinators</li>
                  <?php } ?>
                  
                  <?php if(Auth::hasRoles(['developer'])) {?>
                  <li>
                    <?php echo $this->Html->link(__("New Coordinator",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages', 
                    'action' => 'add_developer']); ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__("View Coordinators"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages', 
                    'action' => 'index_developer']); ?>
                  </li>                     
                  <?php } ?>

                  <?php if(Auth::hasRoles(['superadmin','stadmin'])) {?>
                  <li>
                    <?php echo $this->Html->link(__("New Coordinator",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages',
                    'action' => 'add']); ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__("View Coordinators"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages',
                    'action' => 'index']); ?>
                  </li>                     
              
                  <?php } ?>

                  <?php if(Auth::hasRoles(['deptcoordinator'])) {?>          
                  <li>
                    <?php echo $this->Html->link(__("New Coordinator",true),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages',
                    'action' => 'add_deptcoord']); ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__("View Coordinators"),[
                    'plugin'=>'support_ticket_system',
                    'controller' => 'ticket_manages',
                    'action' => 'index_deptcoord']); ?>
                  </li>

                  <?php } ?>

              </ul>
          </li>
          
<!-- Coordinators/Staffs dropdown ends  here -->

<!-- Reports, Views and Settings dropdown starts from here -->

          
					<li class="col-sm-2">
						<ul>
              <!-- Report starts -->
              <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) {?>
							<li class="dropdown-header">Reports</li>
							 <li>
                <?php echo $this->Html->link(__("Column Charts"),[
                'plugin'=>'support_ticket_system',
                'controller' => 'tickets', 
                'action' => 'column_tickets']); ?>
              </li>

              <li>
                <?php echo $this->Html->link(__("Pie Chart"),[
                'plugin'=>'support_ticket_system',
                'controller' => 'tickets',
                'action' => 'pie_tickets']); ?>
              </li>
              <!-- Report ends -->

           <li class="divider"></li>

              <!-- View starts -->
              <li class="dropdown-header">View</li>          
                <li>
                  <?php if(Auth::user('student_id')){ 
                    echo $this->Html->link(__("View Profile"),[
                    'plugin'=>false,
                    'controller' => 'students',
                    'action' => 'view',
                    AuthComponent::user('student_id')]); } ?>
                  </li>
                <li>
                  <?php if(Auth::user('staff_id')) { 
                    echo $this->Html->link(__("View Profile"),[
                    'plugin'=>false,
                    'controller' => 'staffs',
                    'action' => 'view', 
                    AuthComponent::user('staff_id')]); } ?>
                </li>
                <!-- View ends -->

              <li>
                <?php if(Auth::hasRoles(['stadmin','superadmin','developer'])) { 
                  echo $this->Html->link(__("Settings"),[
                  'plugin'=>'support_ticket_system',
                  'controller' => 'settings',
                  'action' => 'index']); } ?>
                </li>
              <?php } ?>			
						</ul>
					</li>            
				</ul>				
			</li>


      
        <li>
          <?php echo $this->Html->link(__("Logout",true),[
          'controller' => 'users' ,
          'action'=>'logout' ,
          'plugin'=>false]); ?>
        </li> 
       
		  </ul>
		</div>
  </div>
</div>