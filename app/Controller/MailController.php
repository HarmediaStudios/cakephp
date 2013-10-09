<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class MailController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
    public $name = 'Mail';

/**
 * This controller does not use a model
 *
 * @var array
 */
//    public $uses = array('VirtualUser', 'VirtualDomain');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
    public function create_user() {
        $domain_id = $this->Session->read('domain_id');

        $list_virtual_domains = Configure::read('list_virtual_domains');
        $this->set(compact('list_virtual_domains', 'domain_id'));

        if ($this->request->is('post')) {
            $this->VirtualUser->create();
            $post_virtual_user = $this->request->data['VirtualUser'];
            $email_info = $this->VirtualUser->find('all', array('conditions' => array('email' => $post_virtual_user['email'])));
            if(count($email_info) == 0) {
                $this->VirtualUser->insertEmail(
                    $post_virtual_user['email'], 
                    $post_virtual_user['password'], 
                    $post_virtual_user['domain_id']
                );
                $this->Session->write('domain_id', $post_virtual_user['domain_id']);
                $this->ok($post_virtual_user['email']. ' has been created');
                $this->redirect('');
            } else {
                debug($this->VirtualUser->getLastQuery());
                $this->error($post_virtual_user['email'] . 'DID NOT get created');
            }
        }
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
    public function get_existing_email() {
        $email = $this->request->data['email'];

        $email_results = $this->VirtualUser->findByEmail($email);

        if (isset($email_results['VirtualUser'])) {
            echo "none";
        } else {
            $this->error("ERROR! Email Exists");
            echo $email_results['VirtualUser']['email'];
        }
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
    public function list_emails() {
        $domain_id = $this->request->data['domain_id'];

        $domain_emails = $this->VirtualUser->find('all', array(
                'conditions' => array(
                    'domain_id' => $domain_id
                ),
                'fields' => array('email'),
            )
        );
        $this->set(compact('domain_emails'));
    }
}
