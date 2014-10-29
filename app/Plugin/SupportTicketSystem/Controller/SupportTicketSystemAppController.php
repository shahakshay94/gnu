<?php

App::uses('AppController', 'Controller');

class SupportTicketSystemAppController extends AppController {
	
  public $components = [
        'Session',
        'DebugKit.Toolbar',
        'RequestHandler',
        'Paginator',
        'HighCharts.HighCharts'
    ];

    public $helper = ['Js'];

}
