<?php
App::uses('AppModel', 'Model');
/**
 * VirtualUser Model
 *
 */
class VirtualDomain extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';


    public $hasMany = array(
        'VirtualUser' => array(
            'foreignKey' => 'domain_id',
        ),
    );
}