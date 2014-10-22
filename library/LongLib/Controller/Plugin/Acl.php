<?php
class LongLib_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract{
	protected $_auth;
    protected $_acl;
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		$auth=Zend_Auth::getInstance();
		$this->_auth=$auth;
		$this->_acl=new LongLib_Acl($auth);
		//$role='guess';
		$r = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
		if($this->_auth->hasIdentity()){
			$level=$this->_auth->getIdentity()->role;
			switch($level){
				case '1':$role="guess";break;
				case '2': $role="user";break;
				case '3': $role="moderator";break;
				case '4': $role="admin";break;
				default:$role="guess";
			}
			$module=$request->getParam('module');
			$controller=$request->getParam('controller');
			$action=$request->getParam('action');
			$resource=$module.':'.$controller;
			if(!$this->_acl->isAllowed($role,$resource,$action)){
				session_destroy();
				$r->gotoUrl('/index/login');
			}
		}
	}
}