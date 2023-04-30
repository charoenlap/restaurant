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
            $result = $this->query("SELECT * FROM res_table");
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
                $menus = $this->query("SELECT * FROM res_menu WHERE category_id = ".$cate['id']);
                foreach($menus->rows as $menu){
                    $result_menu[] = array(
                        'id' => $menu['id'],
                        'name' => $menu['name'],
                        'price' => $menu['price']  
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
            $sql = "SELECT * FROM res_order 
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
            $result = $this->update('order',$update,'table_id='.$table_id);
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
	}
?>