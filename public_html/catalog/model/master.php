<?php
    class MasterModel extends db {
        public function updateOrderPrint($id=0){
            $result = array();
            $update = array(
                'flag_printer' =>  1 
            );
            $result = $this->update('order',$update,'id='.$id);
            return $result; 
        }
        public function getTable(){
            $result = array();
            $result = $this->query("SELECT * FROM res_table ORDER BY sort ASC");
            return $result;
        }
        public function getTableID($table=0){
            $result = array();
            $result = $this->query("SELECT * FROM res_table WHERE id = ".(int)$table." ORDER BY sort ASC");
            return $result;
        }
        public function getSumPayment($month=0){
            $result = array();
            $where = ' WHERE id<>0 ';
            if(!empty($month)){
                $where .= " AND MONTH(date_create) = '".$month."'";
            }
            $result = $this->query("SELECT DATE(date_create) AS order_date, SUM(amount) AS total_amount, id FROM res_payment ".$where." GROUP BY DATE(date_create) ORDER BY order_date DESC");
            return $result;
        }
        public function getSumPayment_v2($month=0){
            $result = array();
            $where = ' WHERE id<>0 ';
            if(!empty($month)){
                $where .= " AND MONTH(date_create) = '".$month."'";
            }
            $result = $this->query("SELECT DATE(date_create) AS order_date, SUM(amount) AS total_amount, id FROM res_payment ".$where." GROUP BY DATE(date_create) ORDER BY order_date DESC");
            return $result;
        }
        public function getTableEmpty(){
            $result = array();
            $result = $this->query("SELECT * FROM res_table WHERE (hide is null or hide=0) AND (table_status=0 or table_status is null) ORDER BY table_name ASC");
            return $result;
        }
        public function changeTable($old_table_id=0,$new_table_id=0){
            $sqlUpdate = "UPDATE res_order SET table_id='".(int)$new_table_id."' WHERE payment_id=0 AND table_id = ".(int)$old_table_id;
            $this->query($sqlUpdate);
        }
        public function getTableForReport(){
            $result = array();
            $result = $this->query("SELECT * FROM res_table WHERE hide is null or hide=0 ORDER BY table_name ASC");
            return $result;
        }
        public function getOrderByPaymentID($payment_id=0){
            $result = array();
            $sql = "SELECT * FROM res_order LEFT JOIN res_menu ON res_menu.id = res_order.menu_id WHERE payment_id = ".(int)$payment_id;
            // echo $sql;
            $result = $this->query($sql);
            return $result;
        }
        public function getHistory($table_id = 0){
            $result = array();
            $result = $this->query("SELECT * FROM res_payment WHERE table_id = ".(int)$table_id." ORDER BY id DESC");
            return $result;
        }
        public function getMenuID($id){
            $result = array();
            $result_menu = $this->query("SELECT * FROM res_menu WHERE id = ".(int)$id." LIMIT 0,1");
            $result = $result_menu->row;
            $result_menu = $this->query("SELECT * FROM res_option WHERE menu_id = ".(int)$id);
            $result['option'] = $result_menu->rows;
            return $result;
        }
        public function getCategory(){
            $result = array();
            $categories = $this->query("SELECT * FROM res_category");
            foreach($categories->rows as $cate){
                $result_menu = array();
                $menus = $this->query("SELECT * FROM res_menu WHERE category_id = ".$cate['id'] . " ORDER BY sort ASC");
                foreach($menus->rows as $menu){
                    $result_menu[] = array(
                        'id' => $menu['id'],
                        'name' => $menu['name'],
                        'price' => $menu['price'],
                        'image' => $menu['image']  
                    );
                }
                $result[] = array(
                    'id'            => $cate['id'],
                    'cate_name'     => $cate['category_name'],
                    'result_menu'   => $result_menu
                );
                
            }
            return $result;
        }
        public function submitOrder($data=array()){
            $result = array();
            $result = $this->insert('order',$data);
            return $result;
        }
        public function submitOrderEdit($data=array(),$id = ''){
            $result = array();
            $result = $this->update('order',$data,'id='.$id);
            return $result;
        }
        public function deleteOrder($id=0){
            $this->delete('order','id='.$id);
        }
        public function submitPrintOrder($table_id){
            $result = array();
            $update = array(
                'flag_confirm' => 1
            );
            $result = $this->update('order',$update," table_id = ".$table_id." AND payment_id=0");
            return $result;
        }
        public function getOrderID($id=0){
            $result = array();
            $sql = "SELECT *,res_order.id AS id,res_menu.id AS menu_id,res_order.price AS price FROM res_order 
            LEFT JOIN res_option ON res_order.option_id = res_option.id 
            LEFT JOIN res_menu ON res_menu.id = res_order.menu_id
            WHERE table_id = ".(int)$id." AND flag_checkout=0";
            $result = $this->query($sql);
            return $result;
        }
        public function getOrders(){
            $result = array();
            $sql = "SELECT table_id,table_name,date_create FROM res_order 
            LEFT JOIN res_table ON res_order.table_id = res_table.id 
            WHERE flag_confirm = 1  AND flag_printer = 0 AND flag_checkout = 0 GROUP BY table_id";
            $tables = $this->query($sql);
            // var_dump($tables->rows);exit();
            foreach($tables->rows as $table){
                $sql_order = "SELECT *,res_order.id AS id FROM res_order 
                LEFT JOIN res_menu ON res_order.menu_id = res_menu.id 
                LEFT JOIN res_option ON res_order.option_id = res_option.id 
                WHERE table_id = ".$table['table_id']." AND flag_confirm = 1 AND flag_printer = 0 AND flag_checkout = 0 ";
                
                $orders = $this->query($sql_order);
                $result_order = array();
                foreach($orders->rows as $order){
                    $result_order[] = array(
                        'id'            => $order['id'],
                        'menu_name'     => $order['name'],
                        'option_name'   => $order['option_name'],
                        'comment'       => $order['comment']
                    );
                }
                $result[] = array(
                    'table_name'    => $table['table_name'],
                    'date_create'   => $table['date_create'],
                    'orders'        => $result_order
                );
            }
            // var_dump($result);
            
            return $result;
        }
        public function getOrdersPrinter($printer_name=''){
            $result = array();
            $where_printer = '';
            if(!empty($printer_name)){
                $where_printer = " AND printer_name = '".$printer_name."'";
            }
            $sql = "SELECT table_id,table_name,date_create FROM res_order 
            LEFT JOIN res_menu ON res_order.menu_id = res_menu.id 
            LEFT JOIN res_table ON res_order.table_id = res_table.id 
            WHERE flag_confirm = 1  AND flag_printer = 0 AND flag_checkout = 0 ".$where_printer." GROUP BY table_id";
            
            $tables = $this->query($sql);
            // var_dump($tables->rows);exit();
            foreach($tables->rows as $table){
                $sql_order = "SELECT *,res_order.id AS id FROM res_order 
                LEFT JOIN res_menu ON res_order.menu_id = res_menu.id 
                LEFT JOIN res_option ON res_order.option_id = res_option.id 
                WHERE table_id = ".$table['table_id']." AND  flag_confirm = 1 AND flag_printer = 0 AND flag_checkout = 0 ".$where_printer;
                
                $orders = $this->query($sql_order);
                $result_order = array();
                foreach($orders->rows as $order){
                    $result_order[] = array(
                        'id'            => $order['id'],
                        'menu_name'     => $order['name'],
                        'option_name'   => $order['option_name'],
                        'comment'       => $order['comment'],
                        'printer_name'  => $order['printer_name']
                    );
                }
                $result[] = array(
                    'table_name'    => $table['table_name'],
                    'date_create'   => $table['date_create'],
                    'orders'        => $result_order
                );
            }
            // var_dump($result);
            
            return $result;
        }
        public function submitCheckout($data){
            $result = array();
            $result = $this->insert('payment',$data);
            return $result;
        }
        public function updateOrderPayment($table_id=0,$payment_id=0){
            $result = array();
            $update = array(
                'payment_id' =>  $payment_id,
                'flag_checkout' => 1
            );
            $result = $this->update('order',$update,'table_id='.$table_id.' AND payment_id = 0 AND flag_checkout = 0');
            return $result;
        }
        public function updateTable($table_id=0,$status=0){
            $result = array();
            if($table_id){
                $update = array(
                    'table_status' =>   $status
                );
                $result = $this->update('table',$update,'id='.$table_id);
            }
            return $result;
        }
        public function getListTagsMenuID($menu_id=0){
            $result = array();
            $sql = "SELECT * FROM res_tags LEFT JOIN res_order_tags ON res_order_tags.tags_id = res_tags.id WHERE menu_id = ".(int)$menu_id;
            $result = $this->query($sql);
            return $result->rows;
        }
        public function getOrderListCategory($date='', $cate_id = ''){
            $result = array();
            $sql = "SELECT
                res_category.category_name,
                SUM(res_order.price) as sum_price, res_category.id
            FROM
                res_category
                INNER JOIN
                res_menu
                ON 
                    res_category.id = res_menu.category_id
                INNER JOIN
                res_order
                ON 
                    res_order.menu_id = res_menu.id ";
            $sql .= " WHERE res_order.date_create like '".$date." %' ";
            if ($cate_id) {
                $sql .= " AND res_category.id = " . $cate_id;
            }
            $sql .= " GROUP BY category_id";
            $result = $this->query($sql);
            return $result;
        }
	}
?>