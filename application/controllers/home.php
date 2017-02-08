<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function check_login()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$result_login = $this->db->query("select * from admin where email='$email' and password='$password'");
		$row_login = $result_login->result();

		if($result_login -> num_rows > 0)
		{

			$data = array(
				'id' => $row_login['0']->id,
				'name' => $row_login['0']->name,
				'email' => $row_login['0']->email,
				'password' => $row_login['0']->password,
				'phone_no' => $row_login['0']->phone_no,
				'status' => $row_login['0']->status,
				'dt_added' => $row_login['0']->dt_added,
				'dt_updated' => $row_login['0']->dt_updated
			);
			$this->session->set_userdata($data);
			redirect('home/index');
		}
		else
		{
			echo "<script>";
			echo "alert('User not Found');";
			echo "</script>";
			$url = base_url().'/index.php/home/login';
			header("refresh:0.01;url=$url");
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
                 redirect('Home/login');
	}
	public function index1()
	{
		$this->load->view('index');
	}
}