<?php 
	class ReportController extends Controller {
        public function index(){
            $data = array(); 
            $data['now_month'] = $now_month = (get('month')?get('month'):date('m'));
            $year = date('Y');
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1, $year));
                $months[$i] = $monthName;
              }
            $data['date_lists'] = $this->model('master')->getSumPayment($now_month)->rows;
            $data['months'] = $months;
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