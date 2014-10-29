<?php
Router::parseExtensions();
Router::connect('/support_ticket_system/:controller', array('plugin'=>'support_ticket_system'));
Router::connect('/support_ticket_system', array('plugin'=>'support_ticket_system','controller' => 'categories', 'action' => 'index'));
Router::connect('/tickets', array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'tickets'));
Router::connect('/createticket', array('plugin'=>'support_ticket_system','controller' => 'tickets', 'action' => 'add'));
Router::connect('/status', array('plugin'=>'support_ticket_systemcontroller' => 'statuses', 'action' => 'index'));
