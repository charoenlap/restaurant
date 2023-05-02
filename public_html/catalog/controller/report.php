<?php 
	class ReportController extends Controller {
        public function index(){
            $data = array(); 
            $data['date_lists'] = $this->model('master')->getSumPayment()->rows;
			$this->view('report',$data); 
		}
		public function history(){
            $data = array();
            $data['tables'] = $this->model('master')->getTableForReport()->rows;
			$this->view('history',$data); 
		}
        public function getHistory(){
            $data = array();
            $table_id = get('table_id');
            $data = $this->model('master')->getHistory($table_id)->rows;
            $this->json($data);
        }
        public function getHistoryOrder(){
            $data = array();
            $payment_id = get('payment_id');
            $data = $this->model('master')->getOrderByPaymentID($payment_id)->rows;
			$this->json($data); 
        }
        public function getSumPayment($date=''){
            $data = array();
            $date = get('date');
            $data = $this->model('master')->getSumPayment($date)->rows;
			$this->json($data); 
        }
    }
?>