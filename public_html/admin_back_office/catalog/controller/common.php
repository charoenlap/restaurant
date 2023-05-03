<?php 
	class CommonController extends Controller {
	    public function header($data=array()) {
	    	$data = array();
	    	$data['kai'] = $this->model('master')->getKai();
	    	// $data['muay'] = $this->model('master')->getMuay();
	    	$this->render('common/header',$data);
	    }
	    public function footer($data=array()){
	    	$this->render('common/footer',$data);
	    }
	    public function logout($data=array()){ 
	    	$this->redirect('home',$data);
	    }
	}
?>