<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientLogin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common','objcom');
    }
    
	public function index()
	{
	    if(!empty($this->session->userdata('client_session')))
        {
            redirect("client-dashboard");
        }else{
            $this->load->view('FRONT/client-login');
        }
	}
	public function client_login_check()
	{
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	    $data = $this->objcom->get_single_record('customers',$where=array('email'=>$email));
	    if(!empty($data))
	    {
	       if($data->password==md5($password))
	       {
	            $session_data = array('client_id' =>$data->id, 'logged_in' => true);
                $this->session->set_userdata('client_session', $session_data);
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
	    $this->session->unset_userdata('client_session');
        //$this->session->sess_destroy();
        redirect('client-login');
	}
	
	
	
	
}
