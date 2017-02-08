<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Academy extends CI_Controller {

	public function index()
	{
		$this->load->view('academy');
	}

	public function add()
	{
		$this->load->view('academy_profile');
	}

	public function add_update()
	{
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Submit'){


			$id = $_REQUEST['app_id'];
			$name = $_REQUEST['description'];

			if($id != ''){

				$data = array(
					'description' => $name,
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);
				$this->db->where('id', $id);
				$this->db->update('setting', $data);
				redirect(base_url() . 'index.php/academy/index');

			}else{

				$data = array(
					'description' => $name,
					'type' => '1',
					'status' => '1',
					'dt_added' => strtotime(date('Y-m-d H:i:s')),
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);
				$this->db->insert('setting', $data);
				redirect(base_url() . 'index.php/academy/index');
			}
		}
	}

	public function single_delete_product()
	{
		$ids = $_REQUEST['ids'];

		$this->db->where('id', $ids);
		$this->db->delete('setting');

		ob_get_clean();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode(['status'=>1]);
		exit;
	}

}