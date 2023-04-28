<?php 
	class ReplayController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id_content 		= (int)get('id_content');
		    	$data['id_content'] = $id_content;
		    	$data['result'] = $this->model('master')->getListReplay($id_content);
		    	$this->view('replay/index',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	    public function add() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	if(method_post()){
		    		$file = $_FILES['cover'];
		    		if(isset($_FILES['cover'])){
			    		$name = time()."_".$_FILES['cover']['name'];
			    		upload( $_FILES['cover'],'../uploads/content/',$name);
			    	}
			    	$insert = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'show'			=> post('show'),
						'url'			=> post('url'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	if($name){
			    		$insert['cover'] = $name;
			    	}
			    	$this->model('master')->insertReplay($insert);
					// var_dump($insert);exit();
			    	redirect('replay');
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('replay/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$this->view('replay/form',$data);
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
		    		$file = $_FILES['cover'];
		    		if(isset($_FILES['cover'])){
			    		$cover = time()."_".$_FILES['cover']['name'];
			    		upload( $_FILES['cover'],'../uploads/content/',$cover);
			    	}
			    	$file = $_FILES['banner'];
		    		if(isset($_FILES['banner'])){
			    		$banner = time()."_".$_FILES['banner']['name'];
			    		upload( $_FILES['banner'],'../uploads/content/',$banner);
			    	}
			    	$id = post('id');
			    	$id_content = post('id_content');
			    	$update = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'show'			=> post('show'),
						'url'			=> post('url'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	if(isset($_FILES['cover']['name'])){
			    		if(!empty($_FILES['cover']['name'])){
			    			$update['cover'] = $cover;
			    		}
			    	}
			    	if(isset($_FILES['banner']['name'])){
			    		if(!empty($_FILES['banner']['name'])){
			    			$update['banner'] = $banner;
			    		}
			    	}
			    	$this->model('master')->updateReplay($update,$id);
			    	redirect('replay&id_content='.$id_content);
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = get('id');
		    		$data['id_content'] = $id_content = get('id_content');
		    		$data['action'] = route('replay/edit');
		    		$data['detail'] = $this->model('master')->getReplay($id);
		    		$this->view('replay/form',$data);
		    	}
	    	}else{
		    	redirect('login');
		    }
	    }
	    public function del() {
	    	$data = array();
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id = get('id'); 
		    	$this->model('master')->delReplay($id);
		    	$this->json('success');
	    	}else{
		    	redirect('login');
		    }
	    }
	}
?>