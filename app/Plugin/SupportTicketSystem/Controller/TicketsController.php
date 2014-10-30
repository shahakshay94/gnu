<?php
App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');
/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 * @property PaginatorComponent $Paginator
 */
class TicketsController extends SupportTicketSystemAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'=>['Staff','Category','Status','User'],
																					'conditions'=>['Ticket.user_id'=>$this->Auth->user('id')]);
		$this->set('tickets', $this->Paginator->paginate());
	}
/**
 * adminindex method
 *
 * @return void
 */
	public function adminindex() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'=>['Staff','Category','Status','User']);
		$this->set('tickets', $this->Paginator->paginate());
	}

/**
 * manage_tickets method
 *
 * @return void
 */
	public function manage_tickets() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		$this->Paginator->settings = array('limit' => $pagination_value,'page' => 1,'contain'=>['Staff','Category','Status','User'],
																					'conditions'=>['Ticket.staff_id'=>$this->Auth->user('staff_id')]);
		$this->set('tickets', $this->Paginator->paginate());
	}

/**
 * change_status method
 *
 * @param int $id
 * @return void
 */
	public function change_status($id = null) {
		if (!$this->Ticket->exists($id)) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Ticket']['id'] = $id;
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The status has been saved.'));
				return $this->redirect(array('action' => 'manage_tickets'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.'));
			}
		}
		unset($this->request->data);
		$statuses = $this->Ticket->Status->find('list');
		$this->set(compact('statuses'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ticket->exists($id)) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		$options = array('conditions' => array('Ticket.' . $this->Ticket->primaryKey => $id),'contain'=>['Staff','Category','Status','User']);
		$this->set('ticket', $this->Ticket->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->loadModel('Setting');
			$data = $this->Setting->find('first');
			$this->Ticket->create();
			$this->request->data['Ticket']['user_id'] = $this->Auth->user('id');
			$this->request->data['Ticket']['status_id'] = $data['Setting']['status_id'];
			$categoryid = $this->request->data['Ticket']['category_id'];
			$staff = $this->Ticket->Category->TicketManage->find('first',[
				                                                          'conditions'=>
				                                                                    ['TicketManage.category_id'=>$categoryid,
				                                                                           'TicketManage.recstatus'=>1]]);
			$this->request->data['Ticket']['staff_id'] = $staff['TicketManage']['staff_id'];
			if ($this->Ticket->save($this->request->data)) {
				$ticketid = $this->Ticket->getLastInsertID();
				$date = date('d-m-Y');
				$this->request->data['Ticket']['id'] = $ticketid;
				$this->request->data['Ticket']['ticket_no'] = $date.'-'.$ticketid;
					if ($this->Ticket->save($this->request->data,true,array('id','ticket_no'))) {
								$this->Session->setFlash(__('The ticket has been saved.'));
								return $this->redirect(array('action' => 'index'));
					}
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Ticket->Category->find('list',array('joins' => array(
           array(
              'table' => 'ticket_manages',
              'alias' => 'TicketManage',
              'type'  => 'right',
              'conditions' => array(
                 'TicketManage.category_id = Category.id',
                 'TicketManage.recstatus = 1' , 
              )
           )
        ),
			'conditions' => array('Category.recstatus' => 1,'Category.institution_id' => $this->Session->read('institution_id'),
                 'Category.department_id' => $this->Session->read('department_id')),
			));
		$statuses = $this->Ticket->Status->find('list',['conditions'=>['Status.recstatus'=>1]]);
		$this->set(compact('categories', 'statuses'));
		//$this->set('ins_id',$this->Session->read('institution_id'));
		//$this->set('dep_id',$this->Session->read('department_id'));
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ticket->exists($id)) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ticket.' . $this->Ticket->primaryKey => $id));
			$this->request->data = $this->Ticket->find('first', $options);
		}
		$categories = $this->Ticket->Category->find('list');
		$statuses = $this->Ticket->Status->find('list');
		$this->set(compact('categories', 'statuses'));
	}

	public function column_tickets() {
     	$this->loadModel('Category');       
        $categories = $this->Category->find('list');
        $tickets = [];
        foreach ($categories as $key => $value) {
        	$count = $this->Ticket->find('count',['conditions'=>['Ticket.category_id'=>$key]]);
        	$tickets[$key] = $count;
        }
        
        $data = [];
		$counter = 0;

		foreach($tickets as $key=>$value) {
			$data[$counter] = (int)$value;
			$counter++;
		}

		$content = [];
		$counter = 0;

		foreach ($categories as $key => $value) {
			$content[$counter] = $value;
			$counter++;
		}

        $chartName = 'Total Tickets';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'columnwrapper',
                            'chartWidth'				=> 800,
                            'chartHeight'				=> 500,
                            'title'					=> 'Categories vs Count',
                            'subtitle'                                  => 'Support Ticket System',
                            'xAxisLabelsEnabled' 			=> FALSE,
                            'xAxisCategories'       	=> $content,
                            'yAxisTitleText' 		=> 'Count',
                            'enableAutoStep' 		=> TRUE,
                            'creditsEnabled'		=> FALSE,
                            'chartTheme'                => 'highroller',

                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Total Ticket')->addData($data);

        $mychart->addSeries($series);
    }

	public function pie_tickets() {
        
        $this->loadModel('Category');       
        $categories = $this->Category->find('list');
        $tickets = [];

        foreach ($categories as $key => $value) {
        	$count = $this->Ticket->find('count',['conditions'=>['Ticket.category_id'=>$key]]);
        	$tickets[$key] = $count;
        }

		$data = [];
		$counter = 0;

		foreach($tickets as $key=>$value) {
			$data[$counter] = (int)$value;
			$counter++;
		}

       $content = [];
       $counter = 0;

       foreach ($categories as $key => $value) {
        	$temp = [];
			array_push($temp, $value,(int)$data[$counter]);
			$content[$counter] = $temp;
			$counter++;
       }
       	
		$chartData = $content;
        $chartName = 'Total Tickets';

        $pieChart = $this->HighCharts->create( $chartName, 'pie' );

        $this->HighCharts->setChartParams(
                                            $chartName,
                                            array
                                            (
                                                'renderTo'				=> 'piewrapper',  // div to display chart inside
                                                'chartWidth'				=> 800,
                                                'chartHeight'				=> 500,
                                                'chartTheme'                            => 'grid',
                                                'title'					=> 'Total tickets',
                                                'plotOptionsShowInLegend'		=> TRUE,
                                                'creditsEnabled' 			=> FALSE
                                            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Tickets')
            ->addData($chartData);

        $pieChart->addSeries($series);

    }

}
