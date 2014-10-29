<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('SupportTicketSystemAppController', 'SupportTicketSystem.Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends SupportTicketSystemAppController {

/**
 * This controller does not use a model
 *
 * @var array
 */

    public function dashboard() {
        $this->loadModel('Ticket');
        $tickets = $this->Ticket->find('count');
        $ticketuser = $this->Ticket->find('count',['conditions'=>['Ticket.user_id'=>$this->Auth->user('id')]]);
        $ticketopen = $this->Ticket->find('count',['conditions'=>['Ticket.user_id'=>$this->Auth->user('id'),'status_id'=> 1]]);
        $ticketclose = $this->Ticket->find('count',['conditions'=>['Ticket.user_id'=>$this->Auth->user('id'),'status_id'=> 2]]);
        $this->set(compact('tickets','ticketuser','ticketopen','ticketclose'));

    }
}
