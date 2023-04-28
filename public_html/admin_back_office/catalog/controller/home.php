<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$id_user = $this->getSession('user_id');
	    	if($id_user){
	    		$data['action'] = route('home');
	    		$data['year'] 	= (get('year')?(int)get('year'):date('Y'));
				$data['month']='';// 	= (get('month')?(int)get('month'):date('m'));
				$data['day'] 	= (int)get('day');
	    		$select = array(
	    			'year' => (int)get('year'),
	    			'month' => (int)get('month'),
	    			'day' => (int)get('day')
	    		);
	    		$data['result'] = $this->model('master')->getTotalPayment($select);
	    		$resultGraph = $this->model('master')->getGraphTotalPayment($select);
	    		// var_dump($resultGraph);
	    		$data['resultGraph'] = array();
	    		$data['resultGraph'][] = array(
	    			'Month','Sales'
	    		);
	    		foreach($resultGraph as $val){
	    			$data['resultGraph'][] = array(
	    				$val['Gmonth'],
	    				(int)$val['amount']
	    			);	
	    		}
	    		$data['resultGraph'] = json_encode($data['resultGraph']);

		    	$this->view('home',$data);
		    }else{
		    	redirect('login');
		    }
	    }
	}
?>