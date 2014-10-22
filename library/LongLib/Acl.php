<?php
class LongLib_Acl extends Zend_Acl{
	public function __construct(Zend_Auth $auth){
		//add resource for acl
		$this->addResource(new Zend_Acl_Resource('default:index'));
		/*$this->addResource(new Zend_Acl_Resource('default:user'));
		$this->addResource(new Zend_Acl_Resource('default:settings'));
		$this->addResource(new Zend_Acl_Resource('admin:index'));
		$this->addResource(new Zend_Acl_Resource('admin:user'));*/
		
		//add role for acl
		$this->addRole(new Zend_Acl_Role('guess'))
			->addRole(new Zend_Acl_Role('user'),'guess')
			->addRole(new Zend_Acl_Role('moderator'),'user')
			->addRole(new Zend_Acl_Role('admin'),'moderator');
			
		//permission for user with controller index
		$this->allow('guess','default:index',array('index'));
		$this->allow('user','default:index',null);
		$this->allow('moderator','default:index',null);
		$this->allow('admin','default:index',null);
		
		//permission for user with controller user
		/*$this->deny('guess','default:user',null);
		$this->allow('user','default:user',null);
		$this->allow('moderator','default:user',null);
		$this->allow('admin','default:user',null);
		
		//permission for user with controller settings
		//$this->deny('guess','default:settings',null);
		$this->allow('user','default:settings',null);
		$this->allow('moderator','default:settings',null);
		$this->allow('admin','default:settings',null);
		
		//permission for module admin index
		$this->allow('guess','admin:index',array('login'));
		$this->allow('user','admin:index',null);
		$this->allow('moderator','admin:index',null);
		$this->allow('admin','admin:index',null);*/
		
		//permission for module admin user
		//$this->allow('moderator','admin:user',);
		//$this->allow('admin','admin:index',null);
		
	}
}