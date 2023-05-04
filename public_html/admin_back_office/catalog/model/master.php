<?php 
    class MasterModel extends db {
        public function login($data=array()){
            $username = $this->escape($data['username']);
            $password = $this->escape($data['password']);
            $result = array();
            $sql = "SELECT * FROM res_user WHERE username = '".$username."' AND password = MD5('".$password."') LIMIT 0,1";
            // echo $sql;exit();
            $result = $this->query($sql);
            return $result->row;
        }
        public function getListMenu(){
            $result = array();
            $sql = "SELECT * FROM res_menu";
            $result = $this->query($sql);
            return $result->rows;
        }
        public function getListTagsMenuID($menu_id=0){
            $result = array();
            $sql = "SELECT * FROM res_tags LEFT JOIN res_order_tags ON res_order_tags.tags_id = res_tags.id WHERE menu_id = ".$menu_id;
            $result = $this->query($sql);
            return $result->rows;
        }
        public function getListTags(){
            $result = array();
            $sql = "SELECT * FROM res_tags";
            $result = $this->query($sql);
            return $result->rows;
        }
        public function addTagsMenu($menu_id,$tags_id){
            $result = array();
            $insert = array(
                'menu_id'   => $menu_id,
                'tags_id'   => $tags_id
            );
            $result = $this->insert('order_tags',$insert);
            return $result;
        }
        public function removeTagsMenu($menu_id=0,$tags_id=0){
            $result = array();
            $result = $this->delete('order_tags','menu_id = '.(int)$menu_id.' AND tags_id = '.(int)$tags_id);
            return $result;
        }
        public function addTag($tag_name=''){
            $result = array();
            $result = $this->insert('tags',array('tag_name'=>$tag_name));
        }
        public function deleteTag($tag_id){
            $result = array();
            $result = $this->delete('tags','id = '.$tag_id);
        }
        public function updateImageMenu($menu_id,$file_name){
            $this->query("UPDATE res_menu SET image='".$this->escape($file_name)."' WHERE id=".(int)$menu_id);
        }
    }
?>