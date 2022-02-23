<?php
class Api_model extends CI_Model{

	function getOrder(){
		$DB2 = $this->load->database('default', TRUE);
		$result = null;
		$DB2->select('*');
		$DB2->from('orders_products');
		return $DB2->get()->result_array();
	}

	function getOneOrder($id){
		$DB2 = $this->load->database('default', TRUE);
		$result = null;
		$DB2->select('*');
		$DB2->from('orders_products');
		$DB2->where('Order_Product_ID', $id);
		return $DB2->get()->result_array();
	}

	public function insert_order($data){
		$DB2 = $this->load->database('default', TRUE);
		$result = null;
		$DB2->insert('orders_products', $data);
		$result= $DB2->insert_id();
		return  $result;
	}

	function update_order($id, $data)
	{
		$DB2 = $this->load->database('default', TRUE);
		$DB2->where('Order_Product_ID',$id);
		// $DB2->where('chart_year',$y);
		// $DB2->where('chart_month',$m);
		$result = $DB2->update('orders_products',$data);
		
		return $result;
	}

	function delete($id)
	{
		$DB2 = $this->load->database('default', TRUE);
		$DB2->where('Order_Product_ID', $id);
		$DB2->delete('orders_products');
		$DB2->trans_complete();

			if ($DB2->trans_status() === false) {
				return false;
			} else {
				return true;
			}
	}
}
