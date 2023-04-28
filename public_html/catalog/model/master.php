<?php
    class MasterModel extends db {
        public function getImageNews($id=0){
            $result = array();
            $result = $this->query("SELECT * FROM gs_news_images WHERE id_news = '".(int)$id."'");
            return $result;
        }
	}
?>