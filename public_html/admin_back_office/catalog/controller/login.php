<?php 
	class LoginController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$data['action'] = route('login/submitLogin');
	    	$data['result'] = get('result');
	    	$this->render('login',$data);
	    }
	    public function submitLogin(){
	    	if(method_post()){
	    		$select = array(
	    			'username' => post('username'),
					'password' => post('password'),
	    		);
	    		$result = $this->model('master')->login($select);

	    		if(isset($result['id'])){
	    			$this->setSession('user_id',$result['id']);
	    			redirect('home');
	    			// var_dump($result);
	    		}else{
	    			redirect('login&result=เข้าสู่ระบบผิดพลาด');
	    		}
	    	}
	    }
	}
?>