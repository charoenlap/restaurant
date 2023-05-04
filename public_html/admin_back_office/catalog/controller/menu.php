<?php 
	class MenuController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
				$data['menus'] = $this->model('master')->getListMenu(); 
				$data['tags'] = $this->model('master')->getListTags(); 
		    	$this->view('menu',$data);
		    }else{
		    	redirect('login');
		    }
	    }
		public function getListTagsMenuID(){
			$data = array();
			$id_user = $this->getSession('user_id');
	    	if($id_user){
				$menu_id = (int)get('menu_id');
				$data = $this->model('master')->getListTagsMenuID($menu_id); 
			}
			$this->json($data);
		}
		public function addTagsMenu(){
			$data = array();
			$id_user = $this->getSession('user_id');
	    	if($id_user){
				$menu_id = (int)get('menu_id');
				$tags_id = (int)get('tags_id');
				$data = $this->model('master')->addTagsMenu($menu_id,$tags_id); 
			}
			$this->json($data);
		}
		public function removeTagsMenu(){
			$data = array();
			$id_user = $this->getSession('user_id');
	    	if($id_user){
				$menu_id = (int)get('menu_id');
				$tags_id = (int)get('tags_id');
				$data = $this->model('master')->removeTagsMenu($menu_id,$tags_id); 
			}
			$this->json($data);
		}
		public function uploadImage(){
			$menu_id = post('menu_id');
			$file_name = $_FILES['image-file']['name'];
			$file_size =$_FILES['image-file']['size'];
			$file_tmp =$_FILES['image-file']['tmp_name'];
			$file_type=$_FILES['image-file']['type'];
			// $file_ext=strtolower(end(explode('.',$_FILES['image-file']['name'])));

			// $extensions= array("jpeg","jpg","png");

			// if(in_array($file_ext,$extensions)=== false){
			// 	echo "Extension not allowed, please choose a JPEG or PNG file.";
			// 	exit;
			// }

			// if($file_size > 2097152){
			// 	echo 'File size must be excately 2 MB';
			// 	exit;
			// }
			$file_name = rand(10000,99999).'_'.$file_name;
			if(move_uploaded_file($file_tmp,"../uploads/".$file_name)){
				$this->model('master')->updateImageMenu($menu_id,$file_name);
				echo "File uploaded successfully.";
			}else{
				echo "Error uploading file.";
			}
		}
	}
?>