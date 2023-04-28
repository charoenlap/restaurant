<?php 
	class NewsController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id_content 		= (int)get('id');
		    	$data['id_content'] = $id_content;
		    	$data['result'] = $this->model('master')->getListNews();
		    	$this->view('news/index',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	    public function add() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	if(method_post()){
					$muntiImages = array();
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
					$id_news = $this->model('master')->insertNews($insert);
					if(isset($_FILES['files'])){
			    		foreach($_FILES['files']['name'] as $key=>$val){ 
			    			$image = time()."_".$_FILES["files"]["name"][$key];
			    			uploadMunti($_FILES["files"]["tmp_name"][$key],'../uploads/',$image);
			    			$muntiImages[] = $image;
			    		}
			    	}
					if($muntiImages){
			    		foreach($muntiImages as $val){
			    			$image_insert = array(
			    				'id_news' 	=> $id_news,
			    				'image'		=> $val
			    			);
			    			$this->model('master')->imageInsertNews($image_insert,$id_content_sub);
			    		}
			    	}
			    	
					// var_dump($insert);exit();
			    	redirect('news');
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('news/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$this->view('news/form',$data);
		    	}
		    }else{
		    	redirect('login');
		    }
	    }
		// getUnbanner
		public function editUnBanner() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	if(method_post()){
		    		$file = $_FILES['path'];
		    		if(isset($_FILES['path'])){
			    		$path = time()."_".$_FILES['path']['name'];
			    		upload( $_FILES['path'],'../uploads/',$path);
			    	}
			    	$id = 1;
			    	$update = array(
			    		'path'			=> post('path')
			    	);
			    	if(isset($_FILES['path']['name'])){
			    		if(!empty($_FILES['path']['name'])){
			    			$update['path'] = $path;
			    		}
			    	}
			    	$this->model('master')->updateUnBanner($update,$id);
			    	redirect('news/editUnBanner');
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['action'] = route('news/editUnBanner');

					$data['result_unbanner'] = $this->model('master')->getUnbanner();
		    		$this->view('news/unbanner',$data);
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
			    	$this->model('master')->updateNews($update,$id);
					if(isset($_FILES['files'])){
			    		foreach($_FILES['files']['name'] as $key=>$val){ 
			    			$image = time()."_".$_FILES["files"]["name"][$key];
			    			uploadMunti($_FILES["files"]["tmp_name"][$key],'../uploads/',$image);
			    			$muntiImages[] = $image;
			    		}
			    	}
					if($muntiImages){
			    		foreach($muntiImages as $val){
			    			$image_insert = array(
			    				'id_news' 	=> $id,
			    				'image'		=> $val
			    			);
			    			$this->model('master')->imageInsertNews($image_insert,$id);
			    		}
			    	}
			    	redirect('news&id_content='.$id_content);
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = get('id');
		    		$data['id_content'] = $id_content = get('id_content');
		    		$data['action'] = route('news/edit');
		    		$data['detail'] = $this->model('master')->getNews($id);
					$data['images'] = $this->model('master')->getImageNews($id);
					// var_dump($data['images']->rows);
		    		$this->view('news/form',$data);
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
		    	$this->model('master')->delNews($id);
		    	$this->json('success');
	    	}else{
		    	redirect('login');
		    }
	    }
		public function delNewsImg() {
	    	$data = array();
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id_img = get('id_img'); 
				$id_content = get('id_content'); 
				$image = get('image');
				unlink('../uploads/'.$image);
		    	$this->model('master')->delNewsImg($id_img);
		    	redirect("news/edit&id=".$id_content);
	    	}else{
		    	redirect('login');
		    }
	    }
	}
?>