<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Haircut_nail extends CI_Controller {

	public function index()
	{
		$this->load->view('haircut_nail');
	}

	public function add()
	{
		$this->load->view('haircut_nail_profile');
	}

	public function image()
	{
		$this->load->view('haircut_nail_images');
	}

	public function insert()
	{

		$app_id = $_REQUEST['app_id'];
		$description = $_REQUEST['description'];

		if($app_id != ''){

			$data = array(
				'description' => $description,
				'dt_updated' => strtotime(date('Y-m-d H:i:s'))
			);
			$this->db->where('id',$app_id);
			$this->db->update('setting',$data);
		}else{

			$data = array(
				'description' => $description,
				'type' => '4',
				'status' => '1',
				'dt_added' => strtotime(date('Y-m-d H:i:s')),
				'dt_updated' => strtotime(date('Y-m-d H:i:s'))
			);
			$this->db->insert('setting',$data);
			$insert_id = $this->db->insert_id();

			## Image Upload ##
			$this->load->library('upload');
			$files = $_FILES;
			$cpt = count($_FILES['userfile']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];
				$this->upload->initialize($this->set_upload_options());
				$this->upload->do_upload();
				$data = array(
					'name' => $_FILES['userfile']['name'],
					'haircutnail_id' => $insert_id,
					'status' => '1',
					'dt_added' => strtotime(date('Y-m-d H:i:s')),
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);
				$this->db->insert('image',$data);
			}
		}
		redirect(base_url().'index.php/haircut_nail/index');
	}

	## Image Upload Creditinals ##
	private function set_upload_options()
	{
		$config = array();
		$config['upload_path'] = './public/images/haircut_nail/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;

		return $config;
	}

	## Single Delete Image ##
	public function single_delete_image()
	{
		$ids = $_REQUEST['ids'];

		$this->db->where('id', $ids);
		$this->db->delete('image');

		ob_get_clean();
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode(['status'=>1]);
		exit;
	}

	## Update Product Image ##
	public function update_product_image()
	{

		$product_id = $this->input->post('product_id');

		## Image Upload ##
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++)
		{
			if($files['userfile']['name'][$i] != ''){

				$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
				$_FILES['userfile']['type']= $files['userfile']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['userfile']['error'][$i];
				$_FILES['userfile']['size']= $files['userfile']['size'][$i];
				$this->upload->initialize($this->set_upload_options());
				$this->upload->do_upload();
				$data = array(
					'haircutnail_id' => $product_id,
					'name' => $_FILES['userfile']['name'],
					'status' => '1',
					'dt_added' => strtotime(date('Y-m-d H:i:s')),
					'dt_updated' => strtotime(date('Y-m-d H:i:s'))
				);
				$this->db->insert('image',$data);
			}
			else{
				redirect(base_url().'index.php/haircut_nail/index');
			}
		}
		redirect(base_url().'index.php/haircut_nail/index');
	}
}