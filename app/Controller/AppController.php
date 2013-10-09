<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('VirtualUser', 'VirtualDomain');

	public $components = array(
        'Session',
        'RequestHandler',
		//'DebugKit.Toolbar',
	);

    public $helpers = array(
        'Form', 
        'Html', 
        'Session', 
        'Js',
    );

    /**
     * require authentication
     * set acls
     * check acls and allow / deny access to page
     *
     * @todo rework to return user object
     *
     * @return void
     */
    function beforeFilter()
    {
        $getVirtualDomains = $this->VirtualDomain->find('list');
        Configure::write('list_virtual_domains', $getVirtualDomains);
    }

    /**
     * Custom method for calling the setFlash error message
     *
     * @param string $message The message to get passed to the browser
     *
     * @return void
     * @author Timothy Haroutunian (tim@broadinstitute.org)
     **/
    function error($message = null)
    {
        $this->Session->setFlash(__($message), 'default', null, 'error');
    }
    
    /**
     * Custom method for calling the setFlash message
     *
     * @param string $message The message to get passed to the browser
     *
     * @return void
     * @author Timothy Haroutunian (tim@broadinstitute.org)
     **/
    function ok($message = null)
    {
        $this->Session->setFlash(__($message), 'default', null, 'info');
    }

}
