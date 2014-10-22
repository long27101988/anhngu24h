<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
	protected function _initSession(){
		Zend_Session::start();
	}
	public function _initDb(){
		$db=$this->getPluginResource('db')->getDbAdapter();
		Zend_Registry::set('db',$db);
	}
	
	protected function _initLoadPlugin(){
		//load plugin acl
		$auth=Zend_Auth::getInstance();
		$acl=new LongLib_Acl($auth);
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->registerPlugin(new LongLib_Controller_Plugin_Acl($auth,$acl));
	}
}
