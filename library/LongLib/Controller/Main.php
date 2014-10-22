<?php
class LongLib_Controller_Main extends Zend_Controller_Action{
	public function init(){
		$base_url=$this->_request->getbaseurl();
		$auth=Zend_Auth::getInstance();
		$templatePath="";
		if(!$auth->hasIdentity()){
			if($this->_request->controller == 'index' && $this->_request->action=='index'){
				$this->view->headTitle("test long");
				$templatePath = TEMPLATE_PATH . '/default/default';
				define('TEMPLATE_PATH_URL','/application/templates/default/default');
				$this->loadTemplate($templatePath);
			}else{
				$this->view->headTitle("test long");
				$templatePath = TEMPLATE_PATH . '/default/default';
				define('TEMPLATE_PATH_URL','/application/templates/default/default');
				$this->loadTemplate($templatePath,'index2');
			}
		}else{
			$this->view->headTitle("test long");
			$templatePath = TEMPLATE_PATH . '/afterlogin/default';
			define('TEMPLATE_PATH_URL','/application/templates/afterlogin/default');
			$this->loadTemplate($templatePath);
		}
		
	}
	
	public function loadTemplate($templatepath,$layout='index'){
		$option=array("layoutPath"=>$templatepath,"layout"=>$layout,"viewSuffix" => 'phtml');
		Zend_Layout::startMvc($option); 
	}
	
	public function sendMail($type,$filepath,$params=null,$isCron=0){
		$fp=fopen($filepath,'r');
		$content=fread($fp,filesize($filepath));
		//echo $content;die();
		switch($type){
			case 'ACTIVE_ACCOUNT':
				$content=sprintf($content,$params['username'],
					$params['link'],
					$params['link'],
					$params['link']
				);
			break;
		}
		if($isCron==0){
			//echo $content;die();
			$tr=new Zend_Mail_Transport_Smtp('127.0.0.1');
			Zend_Mail::setDefaultTransport($tr);
			$mail = new Zend_Mail ( 'UTF-8' );
			$mail->setReplyTo('admin@fileshare.com', 'fileshare.com');
			$mail->addHeader('MIME-Version', '1.0');
			$mail->addHeader('Content-Transfer-Encoding', '8bit');
			$mail->addHeader('X-Mailer:', 'PHP/'.phpversion());
			$mail->setBodyHtml ( ($content) );
			$mail->addTo ($params['email_receive'] );
			$mail->setSubject ( $params['title'] );
			$mail->setFrom ('admin@fileshare.com' , 'FileShare');
			try{
				$mail->send ();
			}catch(Exception $ex){
				die($ex->getMessage());
			}
		}else{
			
		}
		
		
	}
	
	public function getListFile($type){
		$listfile=array();
		$db=Zend_Registry::get('db');
		if($type!=""){
			$sql="select * from files where isfolder=0 and isdel=0 and iserror=0 and type='{$type}'";
			$listfile=$db->fetchAll($sql);
		}
		return $listfile;
	}
	
	
	
}