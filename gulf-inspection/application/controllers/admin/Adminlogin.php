<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common','objcom');
    }
    
    
    public function index()
	{
	    if(!empty($this->session->userdata('admin_session')))
        {
            redirect("admin-dashboard");
        }else{
            $this->load->view('ADMIN/admin-login');
        }
		
	}
	
	public function admin_login_check()
	{
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	    $data = $this->objcom->get_single_record('admin',$where=array('email'=>$email));
	    if(!empty($data))
	    {
	       if($data->password==$password)
	       {
                $department = $data->department;
                $dept_data = $this->objcom->get_single_record('departments',$where=array('id'=>$department));
	            $session_data = array('admin_id' =>$data->id,'department_name' =>$dept_data->name, 'department' =>$dept_data->id, 'logged_in' => true);
                $this->session->set_userdata('admin_session', $session_data);
                
                // Get user ID
                $user_id = $data->id;
                // Get user permissions
                $permissions = $this->get_permissions_by_user($user_id);
                // Store permissions in session
                $this->session->set_userdata('permissions', $permissions);
                echo "logginSCS"; 
	           
	       }else{
	           echo "WRONGPASS";
	       }
	    }else{
	        echo "account404";
	    }
	}
	
	function logout()
	{
	    $this->session->unset_userdata('admin_session');
        $this->session->sess_destroy();
        redirect('admin-login');
	}
	public function get_permissions_by_user($user_id) {
        $this->db->select('module_id, read_ope, write_ope, delete_ope');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('permissions');
        $result = $query->result_array();
        
        $permissions = [];
        foreach ($result as $row) {
            $permissions[$row['module_id']] = [
                'read' => $row['read_ope'],
                'write' => $row['write_ope'],
                'delete' => $row['delete_ope']
            ];
        }

        return $permissions;
    }
	
/*MAin Class Ended*/	
}
