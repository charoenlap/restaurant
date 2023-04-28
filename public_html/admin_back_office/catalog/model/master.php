<?php 
    class MasterModel extends db {
        public function getUnbanner(){
            $result = array();
            $result = $this->query("SELECT * FROM gs_unbanner WHERE ID = 1 LIMIT 0,1");
            return $result->row;
        }
        public function getImageNews($id=0){
            $result = array();
            $result = $this->query("SELECT * FROM gs_news_images WHERE id_news = '".(int)$id."'");
            return $result;
        }
        public function updateUnBanner($data=array(),$id=0){
            $query = $this->update("unbanner",$data,"id = '".$id."'"); 
            return $query;
        }
        public function getAgency($id=0){
            $result = array();
            $sql = "SELECT * FROM gs_member WHERE gs_member.`ref_id` = ".(int)$id;
            $result = $this->query($sql)->rows;
            return $result;
        }
        public function checkActive($id=0){
            $result = array();
            $sql = "SELECT * FROM gs_member_history 
            LEFT JOIN gs_package ON gs_member_history.id_package = gs_package.id 
            WHERE id_user = '".(int)$id."' AND date_expired >= '".date('Y-m-d H:i:s')."'";
            $query = $this->query($sql);
            $sum_day = 0;
            $sum_unit = 0;
            $id_content = array();
            if($query->num_rows){
                foreach($query->rows as $val){
                    $sum_day += (int)$query->row['days'];
                    $sum_unit += (int)$query->row['unit'];
                    $id_content[] = $query->row['id_content'];

                    $result['data'] = array(
                        'days' => $query->row['days'],
                        'unit' => $query->row['unit'],
                        'id_content' => $query->row['id_content'],
                    );
                }
                $result['days'] = $sum_day;
                $result['unit'] = $sum_unit;
                $result['id_content'] = $id_content;
            }
            return $result;
        }
        public function getListBanner(){
            $sql = "SELECT *,
            gs_news.id AS id,
            gs_news.detail AS detail,
            gs_news.cover AS cover,
            gs_news.title AS title 
            FROM gs_news 
            LEFT JOIN gs_content_sub ON gs_news.ref_content_sub_id = gs_content_sub.id 
            WHERE (gs_news.`show` = '1' AND gs_content_sub.date_start >= NOW() - INTERVAL 1 DAY AND gs_content_sub.del <>1)
             OR (gs_news.id = 48 AND gs_news.del<>1)
            ORDER BY gs_content_sub.date_start ASC  ";
            $query = $this->query($sql); 
            // echo "<pre>";var_dump($query->rows);exit();
            return $query->rows;
        }
        public function getListContentSub(){
            $sql = "SELECT *,
            gs_content_sub.id AS id,
            gs_content_sub.detail AS detail,
            gs_content_sub.cover AS cover,
            gs_content_sub.title AS title 
            FROM gs_content_sub 
            WHERE (gs_content_sub.date_start >= NOW() - INTERVAL 1 DAY AND gs_content_sub.del <>1)
            ORDER BY gs_content_sub.date_start ASC  ";
            $query = $this->query($sql); 
            // echo "<pre>";var_dump($query->rows);exit();
            return $query->rows;
        }
        public function login($data = array()){
            $username = $this->escape(isset($data['username'])?$data['username']:'');
            $password = $this->escape(isset($data['password'])?$data['password']:'');
            $result = $this->query("SELECT * FROM gs_user WHERE username = '".$username."' AND password = '".md5($password)."' ");
            return $result->row;
        }
        public function getUserDetail($data = array()){
            $id = $this->escape(isset($data['id'])?$data['id']:'');
            $result = $this->query("SELECT * FROM gs_user WHERE id = '".$id."' limit 0,1");
            return $result->row;
        }
        public function getTotalPayment($data=array()){
            $where = " WHERE gs_callback.id <> ''";
            // var_dump($data);
            if($data['year']){
                $where .= " AND YEAR(gs_callback.create_date) = '".$data['year']."'";
            }else{
                $where .= " AND YEAR(gs_callback.create_date) = '".date('Y')."'";
            }
            if($data['month']){
                $where .= " AND MONTH(gs_callback.create_date) = '".$data['month']."'";
            }
                // else{
                // $where .= " AND MONTH(gs_callback.create_date) = '".date('m')."'";
            // }
            if($data['day']){
                $where .= " AND DAY(gs_callback.create_date) = '".$data['day']."'";
            }
            $sql = "SELECT *,gs_callback.create_date AS create_date FROM gs_callback 
            INNER JOIN gs_member_payment ON gs_callback.billPaymentRef1 COLLATE utf8_unicode_ci = gs_member_payment.billPaymentRef1 COLLATE utf8_unicode_ci
            LEFT JOIN gs_member ON gs_member.id = gs_member_payment.user_id 
            LEFT JOIN gs_content_sub ON gs_member_payment.id_content = gs_content_sub.id ".$where.' 
            ORDER BY gs_member_payment.date_create DESC';
            $query = $this->query($sql); 
            return $query->rows;
        }
        public function getGraphTotalPayment($data=array()){
            $where = " WHERE gs_callback.id <> '' AND (gs_callback.package_id>0)";
            // var_dump($data);
            if($data['year']){
                $where .= " AND YEAR(gs_callback.create_date) = '".$data['year']."'";
            }else{
                $where .= " AND YEAR(gs_callback.create_date) = '".date('Y')."'";
            }
            // if($data['month']){
            //     $where .= " AND MONTH(gs_callback.create_date) = '".$data['month']."'";
            // }else{
            //     $where .= " AND MONTH(gs_callback.create_date) = '".date('m')."'";
            // } 
            // if($data['day']){
            //     $where .= " AND DAY(gs_callback.create_date) = '".$data['day']."'";
            // }
            $sql = "SELECT 
            SUM(amount) AS amount ,
            MONTH(gs_callback.create_date) AS Gmonth,
            YEAR(gs_callback.create_date) AS Gyear 
            FROM gs_callback 
            INNER JOIN gs_member_payment ON gs_callback.billPaymentRef1 COLLATE utf8_unicode_ci = gs_member_payment.billPaymentRef1 COLLATE utf8_unicode_ci
            LEFT JOIN gs_member ON gs_member.id = gs_member_payment.user_id 
            LEFT JOIN gs_content_sub ON gs_member_payment.id_content = gs_content_sub.id ".$where."
            GROUP BY Gmonth
            ";
            $query = $this->query($sql); 
            // echo "test";
            // var_dump($query->rows);exit();

            return $query->rows;
        }
        public function listOnline(){
            $sql = "SELECT * FROM gs_member WHERE last_online >  DATE_SUB(NOW(), INTERVAL 5 SECOND)";
            $query = $this->query($sql); 
            return $query->rows;
        }
        public function getTopic(){
            $sql = "SELECT * FROM gs_content_sub GROUP BY title";
            $query = $this->query($sql); 
            return $query->rows;
        }
        public function listPackage(){
            $query = $this->query("SELECT * FROM gs_package ORDER BY id DESC"); 
            return $query->rows;
        }
        public function insertPackage($data=array()){
            $query = $this->insert("package",$data); 
            return $query;
        }
        public function insertMemberPackage($data=array()){
            $query = $this->insert("member_history",$data); 
            return $query;
        }
        public function deleteMemberPackage($id=0){
            $query = $this->delete("member_history","id = '".(int)$id."'"); 
            return $query;
        }
        public function delNewsImg($id=0){
            $query = $this->delete("news_images","id = '".(int)$id."'"); 
            return $query;
        }
        public function getPackage($id=0){
            $query = $this->query("SELECT * FROM gs_package WHERE id = ".(int)$id); 
            return $query->row;
        }
        public function updatePackage($data=array(),$id=0){
            $query = $this->update("package",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delPackage($id=0){
            $query = $this->delete("package","id = '".(int)$id."'"); 
            return $query;
        }
        public function listMember(){
            $query = $this->query("SELECT * FROM gs_member WHERE del<>1 ORDER BY id DESC"); 
            return $query->rows;
        }
        public function insertMember($data=array()){
            $query = $this->insert("member",$data); 
            return $query;
        }
        public function imageInsert($data=array()){
            $query = $this->insert("content_sub_images",$data); 
            return $query;
        }
        public function imageInsertNews($data=array()){
            $query = $this->insert("news_images",$data); 
            return $query;
        }
        public function getListImages($id_content_sub){
            $query = $this->query("SELECT * FROM gs_content_sub_images WHERE id_content_sub = '".(int)$id_content_sub."' ORDER BY id DESC"); 
            return $query;
        }
        public function getMemberPackage($id=0){
            $sql  ="SELECT *,
            gs_member_history.id AS id,
            gs_member_history.id_content AS id_content,

            gs_package.title AS package_title,
            gs_content_sub.title AS content_title, 
            gs_member_history.date_create AS date_create
            FROM gs_member_history 
                LEFT JOIN gs_package ON gs_member_history.id_package = gs_package.id 
                LEFT JOIN gs_content_sub ON gs_content_sub.id = gs_member_history.id_content 
                WHERE gs_member_history.id_user ='".(int)$id."'";
            $query = $this->query($sql); 
            return $query->rows;
        }
        public function getMember($id=0){
            $query = $this->query("SELECT * FROM gs_member WHERE id = ".(int)$id); 
            return $query->row;
        }
        public function updateMember($data=array(),$id=0){
            $query = $this->update("member",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delMember($id=0){
            $data = array(
                'del' => '1',
                'token' => ''
            );
            $query = $this->update("member",$data,"id = '".(int)$id."'"); 
            return $query;
        }
        public function kickMember($id=0){
            $data = array(
                'token' => ''
            );
            $query = $this->update("member",$data,"id = '".(int)$id."'"); 
            return $query;
        }
        public function reset($id=0){
            $password = rand(1000,9999);
            $query = $this->update("member",array('password'=>md5($password)),"id = '".(int)$id."'"); 
            return array('password'=>$password); 
        }
        public function getKai(){
            $query = $this->query("SELECT * FROM gs_content WHERE del<>1"); 
            return $query->rows;
        }
        public function getMuay(){
            $query = $this->query("SELECT * FROM gs_content WHERE  del<>1"); 
            return $query->rows;
        }
        public function getSubTopic($id=0){
            $query = $this->query("SELECT * FROM gs_content_sub WHERE id_content = ".(int)$id." AND del<>1 ORDER BY id DESC");
            return $query->rows;
        }
        public function insertContentSub($data=array()){
            $query = $this->insert("content_sub",$data); 
            return $query;
        }
        public function updateContentSub($data=array(),$id=0){
            $query = $this->update("content_sub",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delContentSub($id=0){
            $query = $this->update("content_sub",array('del'=>'1'),"id = '".(int)$id."'"); 
            return $query;
        }
        public function getContentSub($id=0){
            $sql = "SELECT * FROM gs_content_sub WHERE id = '".(int)$id."' AND del=0";
            $query = $this->query($sql); 
            return $query->row;
        }
        public function insertNews($data=array()){
            $query = $this->insert("news",$data); 
            return $query;
        }
        public function updateNews($data=array(),$id=0){
            $query = $this->update("news",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delNews($id=0){
            $query = $this->update("news",array('del'=>'1'),"id = '".(int)$id."'"); 
            // $query = $this->delete("news","id = '".(int)$id."'"); 
            return $query;
        }
        public function getNews($id=0){
            $sql = "SELECT * FROM gs_news WHERE id = '".(int)$id."' AND del<>1";
            $query = $this->query($sql); 
            return $query->row;
        }
        public function getListNews($id=0){
            $sql = "SELECT * FROM gs_news  WHERE del<>1 AND (`url`='' OR `url` is null ) ORDER BY id DESC";
            $query = $this->query($sql); 
            return $query->rows;
        }
        
        public function insertReplay($data=array()){
            $query = $this->insert("news",$data); 
            return $query;
        }
        public function updateReplay($data=array(),$id=0){
            $query = $this->update("news",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delReplay($id=0){
            $query = $this->update("news",array('del'=>'1'),"id = '".(int)$id."'"); 
            // $query = $this->delete("news","id = '".(int)$id."'"); 
            return $query;
        }
        public function getReplay($id=0){
            $sql = "SELECT * FROM gs_news WHERE id = '".(int)$id."' AND del<>1";
            $query = $this->query($sql); 
            return $query->row;
        }
        public function getListReplay($id=0){
            $sql = "SELECT * FROM gs_news  WHERE `url`<>'' AND del<>1 ORDER BY id DESC";
            $query = $this->query($sql); 
            return $query->rows;
        }

        public function insertSponser($data=array()){
            $query = $this->insert("sponser",$data); 
            return $query;
        }
        public function updateSponser($data=array(),$id=0){
            $query = $this->update("sponser",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delSponser($id=0){
            $query = $this->update("sponser",array('del'=>'1'),"id = '".(int)$id."'"); 
            // $query = $this->delete("sponser","id = '".(int)$id."'"); 
            return $query;
        }
        public function getSponser($id=0){
            $sql = "SELECT * FROM gs_sponser WHERE id = '".(int)$id."' AND del<>1";
            $query = $this->query($sql); 
            return $query->row;
        }
        public function getListSponser($id=0){
            $sql = "SELECT * FROM gs_sponser  WHERE del<>1 ORDER BY id DESC";
            $query = $this->query($sql); 
            return $query->rows;
        }

        public function insertMarquee($data=array()){
            $query = $this->insert("marquee",$data); 
            return $query;
        }
        public function updateMarquee($data=array(),$id=0){
            $query = $this->update("marquee",$data,"id = '".$id."'"); 
            return $query;
        }
        public function delMarquee($id=0){
            $query = $this->update("marquee",array('del'=>'1'),"id = '".(int)$id."'"); 
            // $query = $this->delete("marquee","id = '".(int)$id."'"); 
            return $query;
        }
        public function getMarquee($id=0){
            $sql = "SELECT * FROM gs_marquee WHERE id = '".(int)$id."' AND del<>1";
            $query = $this->query($sql); 
            return $query->row;
        }
        public function getListMarquee($id=0){
            $sql = "SELECT * FROM gs_marquee  WHERE del<>1 ORDER BY id DESC";
            $query = $this->query($sql); 
            return $query->rows;
        }
    }
?>