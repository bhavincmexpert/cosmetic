<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Service extends CI_Controller {

	public function index()
	{
		$this->load->view('service');
	}

	public function add()
	{
		$this->load->view('service_profile');
	}

	public function add_update()
	{
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Submit'){

			$id = $_REQUEST['app_id'];
			$name = $_REQUEST['name'];
			$image = time().$_FILES['userfile']['name'];

			if($id != ''){

				$query = $this->db->query("SELECT * FROM services WHERE id = '$id'");
				$result = $query->row_array();

				$db_image = $result['image'];

				if($_FILES['userfile']['name'] != ''){

					$config['upload_path'] = './public/images/service/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_width'] = 0;
					$config['max_height'] = 0;
					$config['max_size'] = 0;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if($this->upload->do_upload())
					{
						$arr_image = array('upload_data' => $this->upload->data());
						$file_name = $arr_image['upload_data']['file_name'];

						$data = array(
							'name' => $name,
							'image' => $file_name,
							'dt_updated' => strtotime(date('Y-m-d H:i:s'))
						);
						$this->db->where('id', $id);
						$this->db->update('services', $data);
						redirect(base_url() . 'index.php/service/index');
					}

				}else{

					$data = array(
						'name' => $name,
						'dt_updated' => strtotime(date('Y-m-d H:i:s'))
					);
					$this->db->where('id', $id);
					$this->db->update('services', $data);
					redirect(base_url() . 'index.php/service/index');
				}
			}else{

				$config['upload_path'] = './public/images/service/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_width'] = 0;
				$config['max_height'] = 0;
				$config['max_size'] = 0;
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (! $this->upload->do_upload())
				{

				}
				else
				{
					$arr_image = array('upload_data' => $this->upload->data());
					$file_name = $arr_image['upload_data']['file_name'];
					$data = array(
						'name' => $name,
						'image' => $file_name,
						'status' => '1',
						'dt_added' => strtotime(date('Y-m-d H:i:s')),
						'dt_updated' => strtotime(date('Y-m-d H:i:s'))
					);

					$this->db->insert('services', $data);
					redirect(base_url() . 'index.php/service/index');
				}
			}
		}
	}

	public function single_delete_product()
	{
		$ids = $_REQUEST['ids'];

		$this->db->where('id', $ids);
		$this->db->delete('services');

		ob_get_clean();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode(['status'=>1]);
		exit;
	}

}