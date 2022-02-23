<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();

		$this->load->model('api_model');
		$this->load->helper('url_helper');

		// header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding, Origin, X-Requested-With, Accept, Authorization');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD");
		header("HTTP/1.1 200 OK");

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// The request is using the POST method
			header("HTTP/1.1 200 OK");
			return;
		}
	}

	public function index()
	{
		$contact = $this->api_model->getOrder();
		$this->output->set_content_type('application/json');
		
		$data = new stdClass();
		if(count($contact) >= 0){
			$data->code = 0;
			$data->data = $contact;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);
		// $this->load->view('welcome_message');
	}

	public function insert()
	{
		// if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// 	header("HTTP/1.1 200 OK");
		// 	$this->output->set_content_type('application/json');
		// 	$data	= file_get_contents("php://input");
		// 	$input	= json_decode($data,true);

		// 	echo $input; 
		// 	exit;
		// }
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// The request is using the POST method
			header("HTTP/1.1 200 OK");
			return;
		}
		$order_product_id 	= $this->input->POST('Order_Product_ID');
		$order_id 			= $this->input->POST('Order_ID');
		$item_name 			= $this->input->POST('Item_Name');
		$normal_price 		= $this->input->POST('Normal_Price');
		$promotion_price 	= $this->input->POST('Promotion_Price');


		$datadb['Order_Product_ID'] = $order_product_id;
		$datadb['Order_ID'] 		= $order_id;
		$datadb['Item_Name'] 		= $item_name;
		$datadb['Normal_Price'] 	= $normal_price;
		$datadb['Promotion_Price'] 	= $promotion_price;


		$result= $this->api_model->insert_order($datadb);

		$data = new stdClass();

		if($result == 0 ){
			$data->code = 0;
			$data->data = $result;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);

	}

	public function update()
	{
		
		$order_product_id 	= $this->input->POST('Order_Product_ID');
		$order_id 			= $this->input->POST('Order_ID');
		$item_name 			= $this->input->POST('Item_Name');
		$normal_price 		= $this->input->POST('Normal_Price');
		$promotion_price 	= $this->input->POST('Promotion_Price');
		// $feedback 	= $this->input->POST('feedback');
		// $source 	= $this->input->POST('source');

		$datadb['Order_Product_ID'] = $order_product_id;
		$datadb['Order_ID'] 		= $order_id;
		$datadb['Item_Name'] 		= $item_name;
		$datadb['Normal_Price'] 	= $normal_price;
		$datadb['Promotion_Price'] 	= $promotion_price;
		// $datadb['feedback'] 		= $feedback ;
		// $datadb['source'] 			= $source ;
		// $datadb['date_created'] 	= date("Y-m-d H:m:s");
		// $datadb['date_modified'] 	= date("Y-m-d H:m:s");

		$result= $this->api_model->update_order($order_product_id, $datadb);

		$data = new stdClass();


		if($result == 1 ){
			$data->code = 0;
			$data->data = $result;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);

	}

	public function delete()
	{
		$order_product_id = $this->input->POST('Order_Product_ID');
		$result= $this->api_model->delete($order_product_id);
		

		$data = new stdClass();


		if($result == true ){
			$data->code = 0;
			$data->data = $result;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);
	}

	public function one_order($id)
	{
		$contact = $this->api_model->getOneOrder($id);
		$this->output->set_content_type('application/json');
		
		$data = new stdClass();
		if(count($contact) >= 0){
			$data->code = 0;
			$data->data = $contact;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);
		// $this->load->view('welcome_message');
	}

	public function one_order2()
	{
		$order_product_id 	= $this->input->GET('Order_Product_ID');
		$contact = $this->api_model->getOneOrder($order_product_id);
		$this->output->set_content_type('application/json');
		
		$data = new stdClass();
		if(count($contact) >= 0){
			$data->code = 0;
			$data->data = $contact;
		}else{
			$data->code = 1;
			$data->msg = "Unable to display data.";
		}
		echo json_encode($data);
		// $this->load->view('welcome_message');
	}
}
