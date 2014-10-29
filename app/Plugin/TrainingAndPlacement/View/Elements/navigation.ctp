<?php
echo $this->Html->css('TrainingAndPlacement.navigation');
?>
<br>
<div class="navbar navbar-default navbar-static-top" style="background-color:#fff;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <p style="padding-left: 20px;">   <?php echo $this->Html->image('gnulogo.png', array('alt' => 'GNU', 'border' => '0')); ?></p>
        </div>
        <div class="navbar-collapse collapse" >
			<ul class="nav navbar-nav">
			<li><?php 
			if (Auth::hasRoles(array('tpadmin','user')) ) {	
			echo $this->Html->link(__("Home",true), [
            'plugin'=> false, 
            'controller' => 'users', 
            'action' => 'dashboard'
         ]); }?></li>
         <li>
         <?php  if (Auth::hasRoles(array('tpadmin')) ) {
            echo $this->Html->link(__("Dashboard",true), [
            'plugin'=>'training_and_placement',
            'controller' => 'company_campuses', 
            'action' => 'home'
            ]);
            } elseif (Auth::hasRoles(array('user')) ) {
            echo $this->Html->link(__("Dashboard",true), [
            'plugin'=>'training_and_placement',
            'controller' => 'placement_results', 
            'action' => 'student_home'
            ]);
            }
         ?>
      	</li><?php if (Auth::hasRoles(array('tpadmin','user')) ) { ?>
	  	<li class="dropdown menu-large">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Campus Placement<b class="caret"></b></a>				
			<ul class="dropdown-menu megamenu row">
				<li class="col-sm-3">
					<ul>
						<li class="dropdown-header">View Profile</li>
					<?php  if (Auth::hasRoles(array('user')) && !Auth::hasRoles(array('tpadmin'))) { ?>
            			<li><?php if(Auth::user('student_id')) { echo $this->Html->link(__("Personal Profile"),array('plugin'=> 'training_and_placement','controller' => 'results_boards', 'action' => 'view', AuthComponent::user('student_id'))); } ?>
						</li>
            			<li>
                    	
	                     <?php echo $this->Html->link(__("SSC/HSC Results",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'results_boards', 
	                        'action' => 'display'
	                     ]); ?>
                  		</li>
                  		<li>
	                     <?php echo $this->Html->link(__("College Results",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'exam_masters', 
	                        'action' => 'display'
	                     ]); ?>
                  		</li>
                  		<?php } ?>
               		<?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>

						<li>
		 					<?php echo $this->Html->link(__("View Student's Profile",true), [
		                  'plugin'=> 'training_and_placement',
		                  'controller' => 'results_boards', 
		                  'action' => 'profile_form'
		               	]); ?>
            			</li>
						<li>
                     	<?php echo $this->Html->link(__("SSC/HSC Results",true), [
                        'plugin'=>'training_and_placement',
                        'controller' => 'results_boards', 
                        'action' => 'result_board_form'
                     	]); ?>
                  		</li>
                  		<li>
                     	<?php echo $this->Html->link(__("College Results",true), [
                        'plugin'=>'training_and_placement',
                        'controller' => 'exam_masters', 
                        'action' => 'exam_master_form'
                     	]); ?>
                  		</li>
                  		<?php } ?>
                  		<li class="divider"></li>
                  		<?php  if (Auth::hasRoles(array('user')) && !Auth::hasRoles(array('tpadmin'))) { ?>
               			<li class="dropdown-header">Company Master</li>	
               			<li>
                     <?php echo $this->Html->link(__("Company Details",true), [
                        'plugin'=>'training_and_placement',
                        'controller' => 'company_job_eligibilities', 
                        'action' => 'company_list'
                     ]); ?>
                  </li>
                  <li>
                     <?php echo $this->Html->link(__("Company Visit Dates",true), [
                        'plugin'=>'training_and_placement',
                        'controller' => 'company_visits', 
                        'action' => 'visit_date'
                     ]); ?>
                  </li>
                  <li>
                     <?php echo $this->Html->link(__("Company & Campus",true), [
                        'plugin'=>'training_and_placement',
                        'controller' => 'company_campuses', 
                        'action' => 'company_campus'
                        ]); ?>
                  </li>

               		<?php } ?>	
						 <?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>
						<li class="dropdown-header">Company Master</li>		
                  		<li>
	                     <?php echo $this->Html->link(__("Add New Company",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'company_campuses', 
	                        'action' => 'company_home'
	                     ]); ?>
                  		</li>
                  		<li>
	                     <?php echo $this->Html->link(__("Basic Company Details",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'company_masters',
	                        'action' => 'index'
	                     ]); ?>
                  		</li>
                  		<li>
	                     <?php echo $this->Html->link(__("Company Visit Dates",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'company_visits', 
	                        'action' => 'index'
	                     ]); ?>
                  		</li>
                  		<li>
	                     <?php echo $this->Html->link(__("Company Job Details",true), [
	                        'plugin'=>'training_and_placement',
	                        'controller' => 'company_jobs', 
	                        'action' => 'index'
	                     ]); ?>
                  		</li>
		                <li>
		                    <?php echo $this->Html->link(__("Job Eligibility",true), [
		                        'plugin'=>'training_and_placement',
		                        'controller' => 'company_job_eligibilities', 
		                        'action' => 'index'
		                    ]); ?>
		                </li>
		                <li>
		                    <?php echo $this->Html->link(__("Company & Campus",true), [
		                        'plugin'=>'training_and_placement',
		                        'controller' => 'company_campuses',
		                         'action' => 'index'
		                    ]); ?>
                  		</li>
                  		<?php }?>

               		</ul>
            	</li>
        </li>
					<?php } ?>	
						 <?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Lists Of</li>
							<li>
               <?php echo $this->Html->link(__("Interested Students",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'placement_results', 
                  'action' => 'form1'
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Referred Companies",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'referred_companies',
                  'action' => 'index'
               ]); ?>
            </li>
            <?php } ?>
            <?php  if (Auth::hasRoles(array('user')) && !Auth::hasRoles(array('tpadmin')) ) { ?>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">AT Campus</li>
							 <li>
               <?php echo $this->Html->link(__("Apply For Campus",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'company_campuses', 
                  'action' => 'student_applied_campus'
               ]); ?>
            </li>
            <li class="divider"></li>
            <li class="dropdown-header">Refer A company</li>
							 <li>
               <?php echo $this->Html->link(__("Refer a Company",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'referred_companies', 
                  'action' => 'add'
               ]); ?>
            </li>
            
            <li>
               <?php echo $this->Html->link(__("Your Reference",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'referred_companies', 
                  'action' => 'display'
               ]); ?>
            </li>
            <?php } ?>	

						 <?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>

							<li class="divider"></li>
							<li class="dropdown-header">Training and Placement Status</li>
							
            <li>
               <?php echo $this->Html->link(__("View Training/Job Status",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'student_statuses', 
                  'action' => 'student_status_form'
               ]); ?>
            </li>
            <?php }?>
            <?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>
								<li class="divider"></li>
							<li class="dropdown-header">Extra</li>
							 <li><?php echo $this->Html->link(__("TODO List",true), [
               'plugin'=>'training_and_placement',
               'controller' => 'tasks', 
               'action' => 'index'
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Send Notification Mail",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'email_notifications', 
                  'action' => 'index'
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Import Data",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'company_campuses', 
                  'action' => 'import_home'
               ]); ?>
            </li><?php } ?>
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
						 
						 <?php  if (Auth::hasRoles(array('tpadmin')) ) { ?>
							<li class="dropdown-header">Charts & Reports</li>
							
						<li><?php echo $this->Html->link(__("Column Chart Hiring",true),[
               'plugin'=>'training_and_placement',
               'controller' => 'company_campuses', 
               'action' => 'column_company_hiring_overall'
               ]); ?> 
               </li>
            <li><?php echo $this->Html->link(__("Column Chart Year",true), [
               'plugin'=>'training_and_placement',
               'controller' => 'company_campuses', 
               'action' => 'column_company_hiring_form'
               ]); ?>
            </li>
            <li><?php echo $this->Html->link(__("Pie Chart Hiring",true),[
               'plugin'=>'training_and_placement',
               'controller' => 'company_campuses', 
               'action' => 'pie_company_hiring_overall'
               ]); ?> 
               </li>
            <li>
               <?php echo $this->Html->link(__("Pie Chart Year",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'company_campuses',
                  'action' => 'pie_company_hiring_form'
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Company Report",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'company_campuses', 
                  'action' => 'find_company_year_form'
               ]); ?>
            </li><?php } ?>
            <?php  if (Auth::hasRoles(array('user')) && !Auth::hasRoles(array('tpadmin')) ) { ?>
						 		<li class="dropdown-header">Resume & Status</li>
						 		<li>
               <?php echo $this->Html->link(__("Training/Job Status",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'student_statuses', 
                  'action' => 'display'
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Resume",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'student_resumes', 
                  'action' => 'view',
                  AuthComponent::user('student_id')
               ]); ?>
            </li>
            <li>
               <?php echo $this->Html->link(__("Your Placement Status",true), [
                  'plugin'=>'training_and_placement',
                  'controller' => 'placement_results', 
                  'action' => 'display'
               ]); ?>
            </li>
             			<?php } ?>	
							

						</ul>
					</li>
			
				</ul> <?php  if (Auth::hasRoles(array('tpadmin','user')) ) { ?>
<li>
         <?php echo $this->Html->link('Logout',[
            'controller' => 'users' ,
            'action'=>'logout', 
            'plugin' => false
         ]); ?>
      </li>
			</li>
		</ul><?php } ?>
		</div>
      </div>
    </div>
