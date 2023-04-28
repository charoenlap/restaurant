<?php 
	class OrderController extends Controller {
		public function index() {
	    	$data = array();
			$this->view('order',$data); 
	    }
	}
?>