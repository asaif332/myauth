<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myauth {
        protected $CI;
        public $user;
        public function __construct()
        {
                $this->CI = & get_instance();
                $this->CI->load->model('myauth_model');
                $this->CI->load->library('session');

                if (!$this->CI->session->userdata('logged_in')) {
                      $this->CI->myauth_model->login_by_cookie();
                }
                date_default_timezone_set('Asia/Kolkata');
                $this->user = $this->user();
        }

        public function check($role = null)
        {

                // check whether logged in
                 if (!$this->CI->session->userdata('logged_in')) {
                        $this->CI->session->set_flashdata('error' , 'You must logged in to access the page');
                        return false;
                }

                if ($role != null) {
                        $role_id = $this->CI->myauth_model->role_id($role);

                        if ($this->user->role_id == null) {
                          $this->CI->session->set_flashdata('error' , 'You are not authorized to access the page');
                          return false;
                        }

                        if ($role_id >= $this->user->role_id) {
                                return true;
                        }
                        $this->CI->session->set_flashdata('error' , 'You must be '. $role .' to access the page');
                        return false;
                }

                return true;
        }

        public function id()
        {
                if (!$this->CI->session->userdata('logged_in')) {
                        return null;
                }
                return $this->CI->session->userdata('logged_in')['user_id'];
        }

        public function user()
        {
                if (!$this->CI->session->userdata('logged_in')) {
                        return null;
                }
                return $this->CI->myauth_model->get($this->CI->session->userdata('logged_in')['user_id']);
        }

        public function role($id)
        {
                return $this->CI->myauth_model->role($id);
        }
}

?>
