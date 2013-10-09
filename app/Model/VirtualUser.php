<?php
App::uses('AppModel', 'Model');
/**
 * VirtualUser Model
 *
 */
class VirtualUser extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';

    public $belongsTo = array(
        'VirtualDomain' => array(
            'foreignKey' => 'domain_id',
        ),
    );

    public function insertEmail($email, $password, $domain_id) {
        $buildQuery = "
            INSERT INTO virtual_users (domain_id, password, email) VALUES (
            '".$domain_id."', ENCRYPT('".$password."', CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))) , '".$email."');
        ";
        return $this->query($buildQuery);
    }

}
