<?php 
	class OrderController extends Controller {
		public function feedPrinter(){
			// $id = (int)get('table_id');
			$printer_name = get('printer_name');
			$result = $this->model('master')->getOrdersPrinter($printer_name);
			$this->json($result);
		}
		public function feedPrinterUpdate(){
			$id = (int)get('order_id');
			$result = $this->model('master')->updateOrderPrint($id);
			$this->json($result);
		}
		public function index() {
	    	$data = array();
			$table_id = get('table_id');
			$data['tableDetail'] = $this->model('master')->getTableID($table_id)->row;
			$data['category'] = $this->model('master')->getCategory();
			$data['tables'] = $this->model('master')->getTableEmpty()->rows;
			$this->view('order',$data); 
	    }
		public function getListTagsMenuID(){
			$menuId = (int)get('menuId');
			$tags = array();
			if($menuId){
				$tags = $this->model('master')->getListTagsMenuID($menuId);
			}
			$this->json($tags);
		}
		public function print() {
	    	$data = array();
			$this->view('print',$data); 
	    }
		public function deleteOrder() {
	    	$data = array();
			// $this->view('print',$data); 
			if(method_post()){
				$id = (int)post('order_id');
				$this->model('master')->deleteOrder($id);
			}
	    }
		public function getMenu(){
			$id = (int)get('menuId');
			$result = $this->model('master')->getMenuID($id);
			$this->json($result);
		}
		public function getOrder(){
			$id = (int)get('table_id');
			$result = $this->model('master')->getOrderID($id);
			$this->json($result->rows);
		}
		public function submitPrintOrder(){
			if(method_post()){
				$data = $_POST;
				$table_id = (int)$data['table_id'];
				$this->model('master')->submitPrintOrder($table_id);
				echo "success";
				// foreach($data['menu_id'] as $key => $val){
				// 	$insert = array(
				// 		'table_id'  => $data['table_id'][$key],
				// 		'menu_id'	=> $data['menu_id'][$key],
				// 		'option_id'	=> $data['option_id'][$key],
				// 		'price'		=> $data['price'][$key],
				// 		'comment'	=> $data['comment'][$key],
				// 		'flag_confirm'	=> 1,
				// 		'flag_printer'	=> 0,
				// 		'flag_checkout'	=> 0,
				// 		'date_create'	=> date('Y-m-d H:i:s'),
				// 	);
				// 	$this->model('master')->submitOrder($insert);
				// 	echo "success";
				// }
			}
		}
		public function submitSingleOrder(){
			if(method_post()){
				$data = $_POST;
				// foreach($data['menu_id'] as $key => $val){
					$insert = array(
						'table_id'  => $data['table_id'],
						'menu_id'	=> $data['menu_id'],
						'option_id'	=> $data['option_id'],
						'price'		=> $data['price'],
						'comment'	=> $data['comment'],
						'flag_confirm'	=> 0,
						'flag_printer'	=> 0,
						'flag_checkout'	=> 0,
						'date_create'	=> date('Y-m-d H:i:s'),
					);
					$result = $this->model('master')->submitOrder($insert);
					$this->model('master')->updateTable($data['table_id'],1);

					$result_menu = $this->model('master')->getMenuID($data['menu_id']);
					if($result_menu['category_id']==5){
						$result_table = $this->model('master')->getTableID($data['table_id'])->row;
						sendNoti('มีออร์เดอร์ โต๊ะ: '.$result_table['table_name'].' เมนู: '.$result_menu['name']);
						echo $result;
					}
				// }
			}
		}
		public function submitSingleOrderEdit(){
			if(method_post()){
				$data = $_POST;
				// foreach($data['menu_id'] as $key => $val){
					$insert = array(
						'table_id'  => $data['table_id'],
						'menu_id'	=> $data['menu_id'],
						'option_id'	=> $data['option_id'],
						'price'		=> $data['price'],
						'comment'	=> $data['comment'],
						'flag_confirm'	=> '0',
						'flag_printer'	=> '0',
						'flag_checkout'	=> '0',
						'date_create'	=> date('Y-m-d H:i:s'),
					);
					$this->model('master')->submitOrderEdit($insert,$data['order_id']);
					$this->model('master')->updateTable($data['table_id'],1);
					echo "success";
				// }
			}
		}
		public function changeTable(){
			if(method_post()){
				$data = $_POST;
				$old_table_id = $data['old_table_id'];
				$new_table_id = $data['new_table_id'];
				$this->model('master')->changeTable($old_table_id,$new_table_id);
				$this->model('master')->updateTable($old_table_id,0);
				$this->model('master')->updateTable($new_table_id,1);
			}
		}
		
	}
?>