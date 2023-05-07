<?php 
	class HomeController extends Controller {
		public function index() {
	    	$data = array();
			$data['tables'] = $this->model('master')->getTable();
			$this->view('home',$data); 
	    }
		public function getTable(){
			$tables = array();
			$tables = $this->model('master')->getTable()->rows;
			$this->json($tables); 
		}
	}
?>