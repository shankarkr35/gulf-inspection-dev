<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common','objcom');
        if(!$this->session->userdata('client_session'))
        {
            return redirect('client-login');
        }
    }
    function delete_file_from_server($filename,$filepath)
    {
        $checkfile = $filepath.$filename;
        if (file_exists($checkfile)) 
        {
            unlink($checkfile);
        }    
    }
	public function index()
	{
        $client_sess = $this->session->userdata('client_session');
        $client_id = $client_sess['client_id'];
        
	    $customers = $this->objcom->get_single_record('customers',array('id'=>$client_id));
        if(!empty($customers)){
            $company_id = $customers->company;
            $company_rec = $this->objcom->get_single_record('companies',array('nameUrl'=>$company_id));
            if(!empty($company_rec)){
                $customers->company_name = $company_rec->name;
            } 
        }
        $data_array['record'] = $customers;
	    $this->load->view('FRONT/include/header');
		$this->load->view('FRONT/include/sidebar');
		$this->load->view('FRONT/dashboard',$data_array);
		$this->load->view('FRONT/include/footer');
	}
	
	function update_client()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $id = $inputData['id'];
        $data_array = $this->objcom->get_single_record('customers',array('id'=>$id));
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
            if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){   
                $file = $this->objcom->updateMedia('file','clients','clients');
                $imagedata['image'] = $file; 
                $path1 = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/uploads/clients/';
                $path2 = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/uploads/clients/medium/';
                $path3 = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/uploads/clients/thumb/';
                if(!empty($data_array->image)){
                    $this->delete_file_from_server($inputData['current_image'],$path3);
                    $this->delete_file_from_server($inputData['current_image'],$path2);
                    $this->delete_file_from_server($inputData['current_image'],$path1);
                }
            
            }
        }
        if(!empty($imagedata['image']))
        {
            $postData['image'] = $imagedata['image'];
        }
        $postData['customer_name'] = $inputData['name'];
        $postData['email'] = $inputData['email'];
        $postData['mobile_number'] = $inputData['phone'];
        $postData['company_name'] = $inputData['company_name'];
        $email = $postData['email'];
        
        $qry = $this->db->query("SELECT * FROM `customers` WHERE `email` = '$email' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('customers',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "email already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
	
	 /*------Reports -----*/
    function reports()
	{
	    $client_sess = $this->session->userdata('client_session');
        $client_id = $client_sess['client_id'];
	    $results = $this->objcom->get_all_where('reports',array('client_id'=>$client_id),$ord="id");
	    if(!empty($results)){
	        foreach($results as $key=>$rec){
	            $user_id = $rec->client_id;
	            $user_arr = $this->objcom->get_single_record('customers',array('id'=>$user_id));
	            if(!empty($user_arr)){
	                $rec->customer_name = $user_arr->customer_name;
	            }
	        }
	    }
	    $data_array['records'] = $results;
	    $this->load->view('FRONT/include/header');
		$this->load->view('FRONT/include/sidebar');
		$this->load->view('FRONT/reports/index',$data_array);
		$this->load->view('FRONT/include/footer');    
	}
	function viewReport($id)
    {
        $data_array['country'] = $this->objcom->get_all_where('country',array('status'=>1),$ord="id");
	    $data_array['companies'] = $this->objcom->get_all_where('companies',array('status'=>1),$ord="id");
        $data_array['clients'] = $this->objcom->get_all_where('customers',array('status'=>1),$ord="id");
        
	    $data_array['governorates'] = $this->objcom->get_all_where('governorates',array('status'=>1),$ord="id");
	    $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
        $data_array['record'] = $this->objcom->get_single_record('reports',array('id'=>$id));
        $this->load->view('FRONT/include/header');
		$this->load->view('FRONT/include/sidebar');
		$this->load->view('FRONT/reports/view',$data_array);
		$this->load->view('FRONT/include/footer');        
    }
    function reportHistory($id)
    {
	    $data_array['records'] = $this->objcom->get_all_where('report_history',array('report_id'=>$id),$ord="id");
        $this->load->view('FRONT/include/header');
		$this->load->view('FRONT/include/sidebar');
		$this->load->view('FRONT/reports/history',$data_array);
		$this->load->view('FRONT/include/footer');        
    }
    function update_client_feedback()
    {
        date_default_timezone_set('Asia/Kuwait');
        $client_sess = $this->session->userdata('client_session');
        $client_id = $client_sess['client_id'];
        $inputData = $this->input->post();
        //echo"<pre>";print_r($inputData);die;
        $id = $inputData['id'];
        $postData['feedback'] = $inputData['client_comment'];
        if($this->objcom->update_records('reports',$postData,$where=array('id'=>$id)))
        {
            
            $this->sendEmail($postData);
           $responseData['responseData'] = "record updated successfully";  
        }else{
            $responseData['responseData'] = "not done";    
        }
        
        echo json_encode($responseData);
        die(); 
    }
    public function sendEmail($postData)
    {
        $email = 'shankar.wxit@gmail.com';
        /*php Mailer Configuration*/
        $email_data = $this->load->view('Emails/feedback_email',$postData,TRUE);
        //$email_data ='Your customer code is :' . $postData['clientName'].' <br><br>';
        $this->load->library('phpmailer_lib');
        //PHPMailer object
        $mail = $this->phpmailer_lib->load();
        //SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'square.solutions24x7@gmail.com';
        $mail->Password = 'oamnvkccuwoadrya';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
                
        $mail->setFrom('square.solutions24x7@gmail.com', 'Gulf Inspection');
        //Add a recipient
        $mail->addAddress($email);
        // Add CC recipients
        $mail->addCC('shankar.wxit@gmail.com');
        //Email subject
        $mail->Subject = "Inspection Report Generation!";
        //Set email format to HTML
        $mail->isHTML(true);
        //Email body content
        $mail->Body = $email_data;
        //Send email
        if($mail->send()){
            return 1;
        }else{
            return 0;
        }
    }
	
	
}
