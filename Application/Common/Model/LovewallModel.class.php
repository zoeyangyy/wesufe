<?php
namespace Common\Model;
use Think\Model\RelationModel;

class LovewallModel extends RelationModel {
	  protected $_link = array(
		'User' => array(
		    'mapping_type' => self::BELONGS_TO,
		    'class_name' => 'User',
		    'foreign_key' => 'userid',
		    'as_fields' => 'image,openid',
		),
    );
}
?>