<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Appointment extends CI_Controller {

	public function index()
	{
		$this->load->view('appointment');
	}

	public function add()
	{
		$this->load->view('appointment_profile');
	}

	public function add_update()
	{
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Submit'){

			$id = $_REQUEST['app_id'];
			$user_id = $_REQUEST['username'];
			$service_id = $_REQUEST['service'];
			$name = $_REQUEST['name'];
			$email = $_REQUEST['email'];
			$phone_no = $_REQUEST['phone_no'];
			$app_date = $_REQUEST['app_date'];

			if($id != ''){

				$data = array(
					'user_id' => $user_id,
					'service_id' => $service_id,
					'name' => $name,
					'email' => $email,
					'phone_no' => $phone_no,
					'date' => $app_date,
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);

				$this->db->where('id', $id);
				$this->db->update('appointment', $data);
				redirect(base_url() . 'index.php/appointment/index');
			}else{

				$data = array(
					'user_id' => $user_id,
					'service_id' => $service_id,
					'name' => $name,
					'email' => $email,
					'phone_no' => $phone_no,
					'date' => $app_date,
					'status' => '1',
					'dt_added' => strtotime(date('Y-m-d H:i:s')),
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);
				$this->db->insert('appointment', $data);
				redirect(base_url() . 'index.php/appointment/index');
			}
		}
	}

	public function single_delete_product()
	{
		$ids = $_REQUEST['ids'];

		$this->db->where('id', $ids);
		$this->db->delete('appointment');

		ob_get_clean();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode(['status'=>1]);
		exit;
	}

}