<?php 
	class KaiController extends Controller {
	    public function index() {
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data = array(); 
		    	$id_content 		= (int)get('id_content');
		    	$data['id_content'] = $id_content;
		    	$data['result'] = $this->model('master')->getSubTopic($id_content);
		    	$this->view('muay/index',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	    public function add() {
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data = array(); 
		    	if(method_post()){
		    		$file = $_FILES['banner'];
		    		if(isset($_FILES['banner'])){
			    		$name = time()."_".$_FILES['banner']['name'];
			    		upload( $_FILES['banner'],'../uploads/content/',$name);
			    	}
			    	$insert = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'location'		=> post('location'),
						'date_start'	=> post('date_start'),
						'id_content' 	=> (int)post('id_content'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	if($name){
			    		$insert['banner'] = $name;
			    	}
			    	$this->model('master')->insertContentSub($insert);
			    	redirect('kai&id_content='.post('id_content'));
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('kai/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$this->view('muay/form',$data);
		    	}
		    }else{
		    	redirect('login');
		    }
	    }
	    public function edit() {
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data = array(); 
		    	if(method_post()){
		    		$file = $_FILES['banner'];
		    		if(isset($_FILES['banner'])){
			    		$name = time()."_".$_FILES['banner']['name'];
			    		upload( $_FILES['banner'],'../uploads/content/',$name);
			    	}
			    	$id = post('id');
			    	$id_content = post('id_content');
			    	$update = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'location'		=> post('location'),
						'date_start'	=> post('date_start'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	if(isset($_FILES['banner']['name'])){
			    		if(!empty($_FILES['banner']['name'])){
			    			$update['banner'] = $name;
			    		}
			    	}
			    	$this->model('master')->updateContentSub($update,$id);
			    	redirect('kai&id_content='.$id_content);
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = get('id');
		    		$data['id_content'] = $id_content = get('id_content');
		    		$data['action'] = route('kai/edit');
		    		$data['detail'] = $this->model('master')->getContentSub($id);
		    		$this->view('muay/form',$data);
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
		    	$this->model('master')->delContentSub($id);
		    	$this->json('success');
		    }else{
		    	redirect('login');
		    }
	    }
	}
?>