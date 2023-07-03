<?php 
	class PackageController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data['result'] = $this->model('master')->listPackage();
	    		$this->view('package/index',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	    public function add() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	if(method_post()){
			    	$insert = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'price'			=> post('price'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	$id_content_sub = $this->model('master')->insertPackage($insert);
			    	redirect('package&id_content='.post('id_content'));
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('package/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$this->view('package/form',$data);
		    	}
		    }else{
		    	redirect('login');
		    }
	    }
	    public function edit() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	if(method_post()){
			    	$id = post('id');
			    	$update = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'price'			=> post('price'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	$this->model('master')->updatePackage($update,$id);
			    	redirect('package&id_content='.$id_content);
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = get('id');
		    		$data['id_content'] = $id_content = get('id_content');
		    		$data['action'] = route('package/edit');
		    		$data['detail'] = $this->model('master')->getPackage($id);
		    		$this->view('package/form',$data);
		    	}
		    }else{
		    	redirect('login');
		    }
	    	
	    }
	    public function del() {
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data = array();
		    	$id = get('id'); 
		    	$this->model('master')->delPackage($id);
		    	$this->json('success');
		    }else{
		    	redirect('login');
		    }
	    }
	}
?>