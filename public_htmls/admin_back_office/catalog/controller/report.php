<?php 
	class ReportController extends Controller {
        public function index(){
            $data = array(); 
            $data['now_month'] = $now_month = (get('month')?get('month'):date('m'));
//            $now_selecKanom = (get('kanom')?get('kanom'):'0');
            $year = date('Y');
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1, $year));
                $months[$i] = $monthName;
              }
            $data['date_lists'] = $this->model('master')->getSumPayment($now_month)->rows;
//            if ($now_selecKanom == '0') {
//                $kanom = (get('kanom')?get('kanom'):'0');
//                foreach ($data['date_lists'] as $key => $value) {
//                    $oderListCategory = $this->model('master')->getOrderListCategory($value['order_date'], '5')->rows;
//                    if ($oderListCategory) {
////                        echo $oderListCategory[0]['sum_price'];
//                        $data['date_lists'][$key]['total_amount'] -= $oderListCategory[0]['sum_price'];
//                    }
//                }
//            }
            $data['months'] = $months;
//            $data['kanom'] = $now_selecKanom;
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
        public function getOrderListCategory(){
            $data = array();
            $date = (get('date')?get('date'):date('Y-m-d'));
            $table_arr_id = (get('table_arr_id')?get('table_arr_id'):'');
            $data = $this->model('master')->getOrderListCategory($date, $table_arr_id)->rows;
			$this->json($data);
        }
        public function getSumPayment_by_type_payment(){
            $data = array();
            $date = (get('date')?get('date'):date('Y-m-d'));
            $table_arr_id = (get('table_arr_id')?get('table_arr_id'):'');
            $data = $this->model('master')->getSumPayment_by_type_payment($date, $table_arr_id)->rows;
			$this->json($data);
        }
        public function getOrderListCategory_kanom(){
            $data = array();
            $date = (get('date')?get('date'):date('Y-m-d'));
            $kanom = (get('kanom')?get('kanom'):'0');
            $data = $this->model('master')->getOrderListCategory($date)->rows;
            if ($kanom == 0) {
                print_r($data);
            }
            $this->json($data);
        }
    }
?>