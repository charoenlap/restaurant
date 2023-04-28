<?php 
	class MemberController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data['result'] = $this->model('master')->listMember();
		    	$this->view('member/index',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	    public function online() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$data['result'] = $this->model('master')->listOnline();
		    	$this->view('member/online',$data);
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
			    		'username'			=> post('username'),
						'date_create' 	=> date('Y-m-d H:i:s')
			    	);
			    	$id_content_sub = $this->model('master')->insertMember($insert);
			    	redirect('member&id_content='.post('id_content'));
		    	}else{
		    		$data['title'] = 'เพิ่ม';
		    		$data['action'] = route('member/add');
		    		$data['id_content'] = (int)get('id_content');
		    		$this->view('member/form',$data);
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
					// var_dump($_POST);exit();
			    	$id = post('id');
			    	$update = array(
			    		'username'			=> post('username'),
						'agency'			=> (int)post('agency'),
						'date_create' 		=> date('Y-m-d H:i:s')
			    	);
					// var_dump($update);exit();
			    	$this->model('master')->updateMember($update,$id);
			    	redirect('member');
		    	}else{
		    		$data['title'] = 'แก้ไข';
		    		$data['id'] = $id = get('id');
		    		$data['action'] = route('member/edit');
		    		$data['detail'] = $this->model('master')->getMember($id);
		    		$data['package'] = $this->model('master')->getMemberPackage($id);
		    		$data['banners'] = $this->model('master')->getListContentSub();
		    		$data['test'] = $this->model('master')->checkActive($id);
					$data['agency_list'] = $this->model('master')->getAgency($id);
		    		// var_dump($data['test']);
		    		$this->view('member/form',$data);
		    	}
		    }else{
		    	redirect('login');
		    }
	    }
	    public function addPackageMember(){
	    	$result = array();
	    	$id_user = get('id_user'); 
			$id_package = get('id_package'); 
			$id_content = get('id_content'); 
			$date_create = get('date_create'); 
			$date_expired = get('date_expired'); 
			$insert = array(
				'id_user' => $id_user,
				'id_package' => $id_package,
				'id_content' => $id_content,
				'date_create' => $date_create,
				'date_expired' => $date_expired,
			);
			$this->model('master')->insertMemberPackage($insert);
	    	$this->json($insert);
	    }
	    public function deleteMemberPackage(){
	    	$result = array();
	    	$id = get('id');  
			$this->model('master')->deleteMemberPackage($id);
	    	$this->json($result);
	    }
	    public function del() {
	    	$data = array();
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id = get('id'); 
		    	$this->model('master')->delMember($id);
		    	$this->json('success');
		    }else{
		    	redirect('login');
		    }
	    }
	     public function kick() {
	    	$data = array();
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
		    	$id = get('id'); 
		    	$this->model('master')->kickMember($id);
		    	$this->json('success');
		    }else{
		    	redirect('login');
		    }
	    }
	    public function reset() {
	    	$data = array();
	    	$id_user = $this->getSession('user_id'); 
	    	if($id_user){
		    	$id = get('id'); 
		    	$result = $this->model('master')->reset($id);
		    	$this->json($result);
		    }else{
		    	redirect('login');
		    }
	    }
	}
?>