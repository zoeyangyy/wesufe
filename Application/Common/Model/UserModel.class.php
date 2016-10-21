<?php
namespace Common\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
    protected $_validate = array(
    	array('openid', '', 'user_exists', 0, 'unique', 1),
    );

}
?>