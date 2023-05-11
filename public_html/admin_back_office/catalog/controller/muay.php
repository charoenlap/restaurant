<?php 
	class MuayController extends Controller {
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
		    		$muntiImages = array();
		    		$file = (isset($_FILES['banner'])?$_FILES['banner']:'');
		    		if(isset($_FILES['banner'])){
			    		$banner = time()."_".str_replace(' ', '_', $_FILES['banner']['name']);
			    		upload( $_FILES['banner'],'../uploads/content/',$banner);
			    	}
			    	$file = $_FILES['cover'];
		    		if(isset($_FILES['cover'])){
			    		$cover = time()."_".str_replace(' ', '_', $_FILES['cover']['name']);
			    		upload( $_FILES['cover'],'../uploads/content/',$cover);
			    	}
			    	if(isset($_FILES['files'])){
			    		foreach($_FILES['files']['name'] as $key=>$val){ 
			    			$image = time()."_".$_FILES["files"]["name"][$key];
			    			uploadMunti($_FILES["files"]["tmp_name"][$key],'../uploads/content_sub/',$image);
			    			$muntiImages[] = $image;
			    		}
			    	}
			    	$insert = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'location'		=> post('location'),
						'date_start'	=> post('date_start'),
						'url'			=> post('url'),
						'id_content' 	=> (int)post('id_content'),
						'id_package' 	=> (int)post('id_package'),
						'date_create' 	=> date('Y-m-d H:i:s'),
						'free'			=> post('free'),
			    	);
			    	if($banner){
			    		$insert['banner'] = $banner;
			    	}
			    	if($cover){
			    		$insert['cover'] = $cover;
			    	}
			    	$id_content_sub = $this->model('master')->insertContentSub($insert);
			    	if($muntiImages){
			    		foreach($muntiImages as $val){
			    			$image_insert = array(
			    				'id_content_sub' 	=> $id_content_sub,
			    				'image'				=> $val
			    			);
			    			$this->model('master')->imageInsert($image_insert,$id_content_sub);
			    		}
			    	}
					$insert = array(
				    	'title'					=> post('title'),
						'detail'				=> post('detail'),
						'show'					=> 1,
						'ref_content_sub_id'	=> $id_content_sub,
						'date_create' 			=> date('Y-m-d H:i:s')
				    );
				    if($banner){
				    	$insert['banner'] = $banner;
				    }
				    if($cover){
				    	$insert['cover'] = $cover;
				    }
			    	$this->model('master')->insertNews($insert);
			    	// $chkHome = post('chkHome');
			    	// if($chkHome){
			    	// 	$insert = array(
				    // 		'title'					=> post('title'),
					// 		'detail'				=> post('detail'),
					// 		'show'					=> 1,
					// 		'ref_content_sub_id'	=> $id_content_sub,
					// 		'date_create' 			=> date('Y-m-d H:i:s')
				    // 	);
				    // 	if($banner){
				    // 		$insert['banner'] = $banner;
				    // 	}
				    // 	if($cover){
				    // 		$insert['cover'] = $cover;
				    // 	}
			    	// 	$this->model('master')->insertNews($insert);
			    	// }
			    	redirect('muay&id_content='.post('id_content'));
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('muay/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$data['topic'] = $this->model('master')->getTopic();
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
		    		$banner = $_FILES['banner'];
		    		if(isset($_FILES['banner'])){
			    		$banner = time()."_".$_FILES['banner']['name'];
			    		upload( $_FILES['banner'],'../uploads/content/',$banner);
			    	}
			    	$cover = $_FILES['cover'];
		    		if(isset($_FILES['cover'])){
			    		$cover = time()."_".$_FILES['cover']['name'];
			    		upload( $_FILES['cover'],'../uploads/content/',$cover);
			    	}
			    	if(isset($_FILES['files'])){
			    		foreach($_FILES['files']['name'] as $key=>$val){ 
			    			$image = time()."_".$_FILES["files"]["name"][$key];
			    			uploadMunti($_FILES["files"]["tmp_name"][$key],'../uploads/content_sub/',$image);
			    			$muntiImages[] = $image;
			    		}
			    	}
			    	$id = post('id');
			    	$id_content = post('id_content');
			    	$update = array(
			    		'title'			=> post('title'),
						'detail'		=> post('detail'),
						'location'		=> post('location'),
						'date_start'	=> post('date_start'),
						'id_package' 	=> (int)post('id_package'),
						'url'			=> post('url'),
						'free'			=> post('free'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	if(isset($_FILES['banner']['name'])){
			    		if(!empty($_FILES['banner']['name'])){
			    			$update['banner'] = $banner;
			    		}
			    	}
			    	if(isset($_FILES['cover']['name'])){
			    		if(!empty($_FILES['cover']['name'])){
			    			$update['cover'] = $cover;
			    		}
			    	}
			    	$this->model('master')->updateContentSub($update,$id);

			    	if($muntiImages){
			    		$id_content_sub = $id;
			    		foreach($muntiImages as $val){
			    			$image_insert = array(
			    				'id_content_sub' 	=> $id_content_sub,
			    				'image'				=> $val
			    			);
			    			$this->model('master')->imageInsert($image_insert,$id_content_sub);
			    		}
			    	}
			    	// $id_content_sub = $this->model('master')->insertContentSub($insert);
			    	$id_content_sub = $id;
			    	// $chkHome = post('chkHome');
			    	// if($chkHome){
			    	// 	$insert = array(
				    // 		'title'					=> post('title'),
					// 		'detail'				=> post('detail'),
					// 		'show'					=> 1,
					// 		'ref_content_sub_id'	=> $id_content_sub,
					// 		'date_create' 			=> date('Y-m-d H:i:s')
				    // 	);
				    // 	if($banner){
				    // 		$insert['banner'] = $banner;
				    // 	}
				    // 	if($cover){
				    // 		$insert['cover'] = $cover;
				    // 	}
			    	// 	// $this->model('master')->insertNews($insert);
			    	// }
			    	redirect('muay&id_content='.$id_content);
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = (int)get('id');
		    		$data['id_content'] = $id_content = get('id_content');
		    		$data['action'] = route('muay/edit');
		    		$data['detail'] = $this->model('master')->getContentSub($id);
		    		$data['topic'] = $this->model('master')->getTopic();
		    		$data['images'] = $this->model('master')->getListImages($id);
					$data['package'] = $this->model('master')->listPackage();
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