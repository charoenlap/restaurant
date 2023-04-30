<?php 
	class CheckoutController extends Controller {
		public function index() {
	    	$data = array();
			$this->view('checkout',$data); 
	    }
        public function submitCheckout(){
            $data = $_POST;
            if(method_post()){
                $insert = array(
                    'payment_id'    => $data['payment_id'],
                    'table_id'      => $data['table_id'],
                    'amount'        => $data['amount'],
                    'date_create'   => date('Y-m-d H:i:s')
                );
                $id_payment = $this->model('master')->submitCheckout($insert);
                $this->model('master')->updateOrderPayment($data['table_id'],$data['payment_id']);
                $this->model('master')->updateTable($data['table_id'],0);
                // redirect('home');
            }
        }
	}
?>