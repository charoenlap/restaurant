<?php 
    class TagsController extends Controller {
        public function index(){
            $id_user = $this->getSession('user_id');
            if($id_user){
                if(method_post()){
                    $data = $_POST;
                    $this->model('master')->addTag($data['tag_name']);
                }
                $data['tags'] = $this->model('master')->getListTags(); 
                $this->view('tags',$data);
            }else{
                redirect('login');
            }
        }
        public function delete(){
            $id_user = $this->getSession('user_id');
            if($id_user){
                $tag_id = get('id');
                $data['tags'] = $this->model('master')->deleteTag($tag_id); 
                redirect('tags');
            }else{
                redirect('login');
            }
        }
    }
?>