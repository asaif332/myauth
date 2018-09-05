<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct()
    {
        parent :: __construct();
        $this->load->model('myauth_model');

    }

    public function index()
    {
        $this->load->view('home');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function add_user()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            return $this->load->view('auth/register');
        }

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        if($this->myauth_model->register($name , $email , $pass)){
            $this->session->set_flashdata('message' , 'Registeration successful');
            return redirect('auth/login');
        }
        $this->session->set_flashdata('message' , 'Something went wrong');
        return $this->load->view('auth/register');
    }


    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            die('already logged in');
        }
        $this->load->view('auth/login');
    }


    public function login_user()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->load->view('auth/login');
        }

        $user = $this->myauth_model->first(['email' => $this->input->post('email')]);
        if (empty($user)) {
            $this->session->set_flashdata('error' , 'Email not found');
            return $this->load->view('auth/login');
        }


        if (!$this->myauth_model->pverify($this->input->post('password') , $user->password)) {
            $this->session->set_flashdata('error' , 'Password doesnt match');
            return $this->load->view('auth/login');
        }

        $this->myauth_model->login($user->id , $this->input->post('remember_me'));
        return redirect('home');

    }


    public function logout()
    {
        $this->myauth_model->logout();
        $this->session->set_flashdata('success' , 'You are logged out');
        return redirect('auth/login');
    }

    public function forgot_password()
    {
        $this->load->view('auth/forgot_password');
    }

    public function reset_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return $this->load->view('auth/forgot_password');
        }

        $user = $this->myauth_model->first(['email' => $this->input->post('email')]);
        if (empty($user)) {
            $this->session->set_flashdata('error' , 'Email not found');
            return $this->load->view('auth/forgot_password');
        }

 
        $this->load->library('email');

        $reset_pass_code = md5(time().rand(1,100));

        $this->email->from('your@example.com', 'EMS');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Password reset');
        $this->email->message('<a href="'.base_url().'auth/change_password/' . $reset_pass_code . '" target="_blank">reset  link </a>');

        if ($this->email->send()) {
            $this->myauth_model->where('id' , $user->id)->update([
                'reset_password_code' => $reset_pass_code,
            ]);


            $sql = "DROP EVENT IF EXISTS user".$user->id;
            $this->myauth_model->query($sql);
            $sql = "CREATE EVENT user".$user->id." ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 MINUTE DO UPDATE users SET reset_password_code = null where id = '$user->id'";
            $this->myauth_model->query($sql);
            
            
            $this->session->set_flashdata('success' , 'Password reset link has been sent. Please check your email');
            return redirect('auth/login');
        }
        $this->session->set_flashdata('error' , 'Some thing went wrong');
        return redirect('auth/login');
    }


    public function change_password($reset_pass_code = null)
    {
        if ($reset_pass_code == null) {
            die('die');
        }

        $user = $this->myauth_model->first(['reset_password_code' => $reset_pass_code]);
        if (!$user) {
            die('Link has been expired');
        }
        else{

            $this->load->view('auth/change_password' , ['reset_pass_code' => $reset_pass_code]);
        }

    }

    public function update_password()
    {
        $reset_pass_code = $this->input->post('reset_pass_code');

        if (empty($reset_pass_code)) {
            die('die');
        }
        else{
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
    
            if ($this->form_validation->run() == FALSE) {
                return $this->load->view('auth/change_password' , ['reset_pass_code' => $reset_pass_code]);
            }

            $user = $this->myauth_model->first(['reset_password_code' => $reset_pass_code]);
            if (!$user) {
                die('Link has been expired');
            }

            $this->myauth_model->update_password($user->id , $this->input->post('password'));
            $this->session->set_flashdata('success' , 'Password successfully changed');
            return redirect('auth/login');
        }
   
    }




}
?>