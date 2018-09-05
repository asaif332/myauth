<?php
class Myauth_model extends CI_Model{
    protected $table = 'users';
    public function __construct()
    {
        parent :: __construct();
        $this->load->database();
        $this->load->library('user_agent');
        $this->load->helper('cookie');

    }

    public function register($name , $email , $pass)
    {
        return  $this->create([
                'name' => $name,
                'email' => $email,
                'password' => $this->phash($pass),
                'role_id' => $this->last_role()->id,
            ]);


    }



    public function login($id , $remember_me = false)
    {
        $this->session->set_userdata('logged_in' , ['user_id' => $id]);

        if ($remember_me) {
            $hash = $this->random_hash();
            $user_agent = $this->agent->agent_string();
            $data = ['hash' => $hash , 'user_agent' => $user_agent , 'user_id' => $id];
            set_cookie('remember_me' , $hash , 2592000);
            $user_session = $this->db->get_where('user_sessions' , ['user_id' => $id , 'user_agent' => $user_agent])->row();

            if ($user_session->id) {
                $this->db->update('user_sessions' , $data , ['id' => $user_session->id]);
            }
            else{
                $this->db->insert('user_sessions' , $data);
            }

        }
    }


    public function login_by_cookie()
    {
        if (get_cookie('remember_me')) {
            $user_session = $this->db->get_where('user_sessions' , ['user_agent' => $this->agent->agent_string() , 'hash' => get_cookie('remember_me')])->row();
            $this->login($user_session->user_id , true);
        }
    }

    public function logout()
    {

        $this->session->unset_userdata('logged_in');
        if (get_cookie('remember_me')) {
            $this->db->delete('user_sessions' , ['user_agent' => $this->agent->agent_string() , 'hash' => get_cookie('remember_me')]);
            delete_cookie('remember_me');
        }

    }

    public function update_password($user_id , $pass)
    {
        $this->db->where('id' , $user_id);
        $this->db->update($this->table , ['password' => $this->phash($pass) , 'reset_password_code' => null]);
    }

    public function role_id($role)
    {
        $r = $this->db->get_where('roles' , ['role' => $role]);
      if ($r->num_rows()) {
        return $r->row()->id;
      }
      return 0;
    }

    public function role($role_id)
    {
        $r = $this->db->get_where('roles' , ['id' => $role_id]);
      if ($r->num_rows()) {
        return $r->row()->role;
      }
      return null;
    }

    public function last_role()
    {
      $this->db->select_max('id');
      $q = $this->db->get($this->table);
      return $q->row();
    }







    private function phash($pass)
    {
        return password_hash($pass , PASSWORD_DEFAULT);
    }

    private function random_hash(){
        return md5(rand(1,100)+ rand(1,100));
    }

    public function pverify($pass , $hash)
    {
        return password_verify($pass , $hash);
    }




    public function query($sql)
    {
        $this->db->query($sql);
    }


  public function get($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get($this->table);
      return $query->result();
    }

    $query = $this->db->get_where($this->table , ['id' => $id]);
    return $query->row();
  }

  public function find($options = [])
  {
    if (empty($options)) {
        return null;
    }

    $query = $this->db->get_where($this->table , $options);
    return $query->result();

  }

  public function first($options = [])
  {
    if (empty($options)) {
        return null;
    }

    $query = $this->db->get_where($this->table , $options);
    return $query->row();

  }


  public function create($options = [])
  {
    return $this->db->insert($this->table , $options);
  }

  public function where($field , $value)
  {
    $this->db->where($field , $value);
    return $this;
  }

  public function update($options = [])
  {
    return $this->db->update($this->table , $options);
  }

  public function delete()
  {
    return $this->db->delete($this->table);
  }



}
?>
