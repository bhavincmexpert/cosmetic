<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller
{

    public function abc()
    {
        $this->load->view('login_admin');
    }
    public function admin_5324514542()
    {
        $this->load->view('login_admin');
    }

    public function index()
    {
        $this->load->view('admin_profile');
    }

    public function check_login()

    {

        $user_email = $this->input->post('txtEmail');

        $user_pass = $this->input->post('txtPassword');

        $result_login = $this->db->query("select * from admin where email='$user_email' and password='$user_pass'");

        if ($result_login->num_rows > 0) {

            $row_login = $result_login->result();

            //session start for admin

            $newdata = array(

                'email_admin' => $row_login['0']->email,

                'id' => $row_login['0']->id,

                'logged_in' => TRUE

            );

            $this->session->set_userdata($newdata);

            redirect('admin/index_admin');


        } else {

            $this->session->set_flashdata('msg', 'Invalid email or password');
            redirect(base_url().'index.php/admin/admin_5324514542');
        }

    }

    public function logout()

    {

        $this->session->sess_destroy();

        redirect('admin/admin_5324514542');

    }

    public function index_admin()

    {

        $this->load->view('index_admin');

    }

    public function update()
    {
        $id = $this->input->post('app_id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $phone_no = $this->input->post('phone_no');

        $data = array(
            'name' => $name,
            'password' => $password,
            'phone_no' => $phone_no,
            'dt_updated' => strtotime(date('Y-m-d H:i:s'))
        );
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        redirect(base_url().'index.php/admin/index');
    }
}

