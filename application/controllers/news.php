<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class News extends CI_Controller {

	public function index()
	{
		$this->load->view('news');
	}

	public function add()
	{
		$this->load->view('news_profile');
	}

	public function abacd()
	{
		$this->load->view('news_profile');
	}


	public function add_update()
	{
		if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'Submit'){

			$id = $_REQUEST['app_id'];
			$name = $_REQUEST['description'];
			$image = time().$_FILES['userfile']['name'];

			if($id != ''){

				$query = $this->db->query("SELECT * FROM setting WHERE id = '$id'");
				$result = $query->row_array();

				$db_image = $result['image'];

				if($_FILES['userfile']['name'] != ''){

					$config['upload_path'] = './public/images/news/';
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
							'description' => $name,
							'image' => $file_name,
							'dt_updated' => strtotime(date('Y-m-d H:i:s'))
						);
						$this->db->where('id', $id);
						$this->db->update('setting', $data);
						redirect(base_url() . 'index.php/news/index');
					}

				}else{

					$data = array(
						'description' => $name,
						'dt_updated' => strtotime(date('Y-m-d H:i:s'))
					);
					$this->db->where('id', $id);
					$this->db->update('setting', $data);
					redirect(base_url() . 'index.php/news/index');
				}
			}else{

				$config['upload_path'] = './public/images/news/';
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
						'description' => $name,
						'image' => $file_name,
						'type' => '2',
						'status' => '1',
						'dt_added' => strtotime(date('Y-m-d H:i:s')),
						'dt_updated' => strtotime(date('Y-m-d H:i:s'))
					);

					$this->db->insert('setting', $data);
					redirect(base_url() . 'index.php/news/index');
				}
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