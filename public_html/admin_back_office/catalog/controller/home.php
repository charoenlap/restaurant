<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
				
		    	$this->view('home',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	}
?>