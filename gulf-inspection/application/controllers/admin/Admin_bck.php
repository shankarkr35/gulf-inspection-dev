<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kuwait');
        $this->load->model('common','objcom');
        $this->load->library('form_validation');
        $this->load->helper('file');
        if(!$this->session->userdata('admin_session'))
        {
            return redirect('admin-login');
        }
        $this->load->library('phpqrcode/qrlib');
    }
    public function index()
	{
		$this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/dashboard');
		$this->load->view('ADMIN/include/footer');
	}
	function delete_file_from_server($filename,$filepath)
    {
        $checkfile = $filepath.$filename;
        if (file_exists($checkfile)) 
        {
            unlink($checkfile);
        }    
    }
    
	function pages()
	{
	    $data_array['pages'] = $this->objcom->get_all_where('pages',$where="",$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function add_new_page()
	{
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function create_new_page()
	{
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $postData['title_en'] = $inputData['name'];
        $postData['title_ar'] = $inputData['ar_name'];
        $postData['page_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['en_desc'] = $inputData['en_desc'];
        $postData['ar_desc'] = $inputData['ar_desc'];
        $url = $postData['page_url'];
        $qry = $this->db->query("SELECT * FROM `pages` WHERE `page_url` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('pages',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
            
        }else{
            
            $responseData['responseData'] = "page name already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	
	function edit_page($id)
    {
        $data_array['page'] = $this->objcom->get_single_record('pages',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function update_page()
    {
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $postData['title_en'] = $inputData['name'];
        $postData['title_ar'] = $inputData['ar_name'];
        $postData['page_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['en_desc'] = $inputData['en_desc'];
        $postData['ar_desc'] = $inputData['ar_desc'];
        $id = $inputData['id'];
        $url = $postData['page_url'];
        $resData = $this->objcom->get_single_record('pages',array('page_url'=>$url,'id !='=>$id));
        if(empty($resData))
        {
            if($this->objcom->update_records('pages',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "page updated";        
            }
        }else{
            $responseData['responseData'] = "page name already exist";    
        }
        
        echo json_encode($responseData);
        die();    
    }
	
	public function removeSpecialChapr($value)
	{
		$title = str_replace( array( '\'', '"', ',' , ';', '<', '>','!', '@', '#' , '$', '%', '^', '&', '*' , '(', ')', '_', '-', '=' , '+', ':', '?', '.', '`', '~', '[', ']', '{', '}', '|' , '/' , '\\' , '‘' , '’' , '“', '”' , '…', '‰' ), '', $value);
		$post_title1 = str_replace( array("  "), array(" "), $title);	
		$post_title = str_replace( array(" ","'"), array("-",""), $post_title1);
		$postTitle = strtolower($post_title);
		return $postTitle;
    }
    function deleteFromany()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        if($this->objcom->delete_record($table,array('id'=>$id)))
        {
            echo "deleted";    
        }
    }
    function status_mange()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status']=$status;
        if($this->objcom->update_records($table,$data,$where=array('id'=>$id)))
        {
            echo "updated";    
        }
    }
    function clientList()
    {
        $data_array['customers'] = $this->objcom->get_all_where('customers',$where="",$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    function add_new_client()
	{
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function create_new_client()
	{
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
            $file = $this->objcom->updateMedia('file','clients','clients');
            $imagedata['image'] = $file; 
        }
        if(!empty($imagedata['image'])){
            $postData['image'] = $imagedata['image'];
        }else{
            $postData['image'] = 'default-image.png';
        }
        $postData['customer_name'] = $inputData['name'];
        $postData['email'] = $inputData['email'];
        $postData['mobile_number'] = $inputData['phone'];
        $postData['password'] = md5($inputData['password']);
        $postData['company_name'] = $inputData['company_name'];
        $email = $postData['email'];
        $qry = $this->db->query("SELECT * FROM `customers` WHERE `email` = '$email'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('customers',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
            
        }else{
            
            $responseData['responseData'] = "email already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	function edit_client($id)
    {
        $data_array['record'] = $this->objcom->get_single_record('customers',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function update_client_record()
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
	function governorates()
	{
	    $data_array['records'] = $this->objcom->get_all_where('governorates',$where="",$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/governorates/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function addGovernorate()
	{
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/governorates/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function createGovernorate()
	{
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `governorates` WHERE `nameUrl` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('governorates',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "name already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	function editGovernorate($id)
    {
        $data_array['record'] = $this->objcom->get_single_record('governorates',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/governorates/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function updateGovernorate()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $id = $inputData['id'];
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `governorates` WHERE `nameUrl` = '$url' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('governorates',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "name already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    function cities()
    {
        $city_arr = array();
        $scateg = $this->objcom->get_all_where('cities',$where="",$ord="id");
        foreach($scateg as $key=>$row)
        {
            $governorateSlug = $row->governorateSlug;
            $data_arr = $this->objcom->get_single_record('governorates',array('nameUrl'=>$governorateSlug));
            if(!empty($data_arr))
            {
                $city_arr[$key]['governorate'] = $data_arr->name;
            }else{
                $city_arr[$key]['governorate'] = '';    
            }
            $city_arr[$key]['id'] = $row->id; 
            $city_arr[$key]['name'] = $row->name; 
            $city_arr[$key]['status'] = $row->status;
            
        }
        $data_array['records'] = $city_arr;
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/cities/index',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function addCities()
    {
        $data_array['governorates'] = $this->objcom->get_all_where('governorates',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/cities/add',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function createCities()
    {
        $inputData = $this->input->post();
        date_default_timezone_set('Asia/Kuwait');
        $postData = array();
        $responseData = array();
        $admin_sess = $this->session->userdata('admin_session');
        
        $admin_id = $admin_sess['admin_id'];
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['governorateSlug'] = $inputData['governorate'];
        $postData['createdby'] = $admin_id;
        $postData['status'] = 1;
        $postData['create_date'] = date("Y-m-d H:i:s");
        
        $url = $postData['nameUrl'];
        $governorate_id = $inputData['governorate'];
        $qry = $this->db->query("SELECT * FROM `cities` WHERE `nameUrl` = '$url' AND governorate_id = '$governorate_id'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('cities',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
       
        echo json_encode($responseData);
        die();
    }
    
    function editCities($id)
    {
        $data_array['governorates'] = $this->objcom->get_all_where('governorates',$where=array('status'=>1),$ord="id");
        $data_array['record'] = $this->objcom->get_single_record('cities',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/cities/edit',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function updateCities()
    {
        $inputData = $this->input->post();
        //echo"<pre>";print_r($inputData);die;
        $postData = array();
        $governorateSlug = $inputData['governorate'];
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['governorateSlug'] = $inputData['governorate'];
        //$postData['governorate_id'] = $governorate_id;
        $id = $inputData['id'];
        $url = $postData['nameUrl']; 
        $qry = $this->db->query("SELECT * FROM `cities` WHERE `nameUrl` = '$url' AND `governorateSlug` = '$governorateSlug' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('cities',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        echo json_encode($responseData);
        die();
    }
    
    /*------- Departsment ------*/
    function departments()
	{
	    $data_array['records'] = $this->objcom->get_all_where('departments',$where="",$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/departments/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function addDepartments()
	{
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/departments/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function createDepartments()
	{
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `departments` WHERE `nameUrl` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('departments',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "name already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	function editDepartments($id)
    {
        $data_array['record'] = $this->objcom->get_single_record('departments',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/departments/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function updateDepartments()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $id = $inputData['id'];
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `departments` WHERE `nameUrl` = '$url' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('departments',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "name already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    
    /*------Reports -----*/
    function reports()
	{
	    $results = $this->objcom->get_all_where('reports',$where="",$ord="id");
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
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/reports/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function addReport()
	{
	    $data_array['clients'] = $this->objcom->get_all_where('customers',array('status'=>1),$ord="id");
	    $data_array['governorates'] = $this->objcom->get_all_where('governorates',array('status'=>1),$ord="id");
	    $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/reports/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
    function createReport()
	{
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        //echo"<pre>";print_r($inputData);die;
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($inputData['report_date'])){
            $report_date = date('Y-m-d',strtotime($inputData['report_date']));
        }else{
            $report_date = date('Y-m-d');
        }
        
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            if(($_FILES['file']['type'] == 'application/pdf') || ($_FILES['file']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || ($_FILES['file']['type'] == 'text/csv')){ 
                $file = $this->objcom->updateMedia('file','reports','reports');
                $imagedata['image'] = $file;
            }else{
                $responseData['responseData'] = "report type"; 
                echo json_encode($responseData);
                die();
            }
            
            if(!empty($imagedata['image'])){
                $postData['report_doc'] = $imagedata['image'];
            }else{
                $postData['report_doc'] = 'default-image.png';
            }
        } else {
            $responseData['responseData'] = "No file uploaded";
            echo json_encode($responseData);
            die();
        }
        
        
        $expiry_date = date('Y-m-d', strtotime('+90 days', strtotime($report_date)));
        $report_url = base_url('uploads/reports/').$postData['report_doc'];
        $unique_token = md5(uniqid(rand(), true)); // Generate a unique token
        $validation_url = base_url('Welcome/validate_qr') . '?token=' . $unique_token;
        
        /*----- QR Code -----*/
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/images/';
        $logo_path = base_url('uploads/logo.jpg');
        $text = $validation_url;
        
        $folder = $SERVERFILEPATH;
        $file_name1 = date('dhis') . "qrcode.png";
        $file_name = $folder . $file_name1;
        $url_name = base_url('images/') . $file_name1;
        
        // Set the QR code size
        $QR_size = 4; // Adjust the size value for a larger QR code
        
        // Generate the QR code
        QRcode::png($text, $file_name, QR_ECLEVEL_H, $QR_size);
        
        // Load the QR code and the logo
        $QR = imagecreatefrompng($file_name);
        $logo = imagecreatefrompng($logo_path); // Use imagecreatefrompng for a PNG logo
        
        // Get dimensions of QR code and logo
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        
        // Increase the size of the logo
        $logo_scale_factor = 6; // Scale factor for resizing the logo (1: smaller, 5: larger)
        $logo_qr_width = (int)($QR_width / $logo_scale_factor);
        $logo_qr_height = (int)($QR_height / $logo_scale_factor);
        $logo_x = (int)(($QR_width - $logo_qr_width) / 2);
        $logo_y = (int)(($QR_height - $logo_qr_height) / 2);
        
        // Create a white background for the resized logo
        $logo_resized = imagecreatetruecolor($logo_qr_width, $logo_qr_height);
        $white = imagecolorallocate($logo_resized, 255, 255, 255);
        imagefill($logo_resized, 0, 0, $white);
        
        // Copy the logo onto the white background
        imagecopyresampled($logo_resized, $logo, 0, 0, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        
        // Merge the logo onto the QR code
        imagecopy($QR, $logo_resized, $logo_x, $logo_y, 0, 0, $logo_qr_width, $logo_qr_height);
        
        // Save the QR code with the logo
        imagepng($QR, $file_name);
        
        // Clean up
        imagedestroy($QR);
        imagedestroy($logo);
        imagedestroy($logo_resized);
        
        // generating padf and insert qr code to each page ----
        $qrcodeimage = FCPATH . "images/".$file_name1;
        $templateFile = FCPATH . "uploads/reports/".$imagedata['image']; // Path to your existing PDF

        // Check if the file exists
        if (!file_exists($templateFile)) {
            show_error('Template file does not exist: ' . $templateFile);
        }

        // Initialize FPDI
        $pdf = new FPDI();
        $pageCount = $pdf->setSourceFile($templateFile);

        // Loop through each page of the template
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // Import a page
            $tplIdx = $pdf->importPage($pageNo);

            // Add a page
            $pdf->AddPage();

            // Use the imported page as the template
            $pdf->useTemplate($tplIdx);

            // Get the size of the imported page
            $size = $pdf->getTemplateSize($tplIdx);

            // Define QR code dimensions
            $qrWidth = 35; // Width of the QR code
            $qrHeight = 35; // Height of the QR code

            if ($pageNo == 1) {
                $qrWidth = 40; // Width of the QR code
                $qrHeight = 40; // Height of the QR code
                // Position for the first page: centered in the middle
                $x = ($size['width'] - $qrWidth) / 12;
                $y = ($size['height'] - $qrHeight) / 1.7;

                // Add QR code image to the first page
                $pdf->Image($qrcodeimage, $x, $y, $qrWidth, $qrHeight);

                // Add text below the QR code on the first page
                $pdf->SetFont('Arial', '', 12);
                $pdf->SetXY($x, $y + $qrHeight + 5); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
                $pdf->Ln();
                $pdf->SetXY($x, $y + $qrHeight + 15); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
            } else {
                // Position for all other pages: centered at the bottom
                $x = ($size['width'] - $qrWidth) / 2;
                $y = $size['height'] - $qrHeight - -15; // Adjust the value to fit your needs

                // Add QR code image to the other pages
                $pdf->Image($qrcodeimage, $x, $y, $qrWidth, $qrHeight);

                // Add text above the QR code on the other pages
                $pdf->SetFont('Arial', '', 12);
                $pdf->SetXY($x, $y - 15); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
                $pdf->Ln();
                $pdf->SetXY($x, $y - 5); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
            }
        }
        // Output the new PDF
        $outputFile = FCPATH . "uploads/reports/".$imagedata['image'];
        $pdf->Output($outputFile, "F");
        //echo "Done generating QR Code PDF.";die;

        // =====END===
        
        $postData['qr_image']= $file_name1;
        /*----- End ---------*/
        $postData['company_name'] = $inputData['company_name'];
        $postData['report_date'] = $report_date;
        $postData['expiry_date'] = $expiry_date;
        $postData['client_id'] = $inputData['client'];
        $postData['report_title'] = $inputData['report_title'];
        $postData['governorateSlug'] = $inputData['governorate'];
        $postData['city_id'] = $inputData['cities'];
        $postData['address1'] = $inputData['address1'];
        $postData['address2'] = $inputData['address2'];
        $postData['giico_job_ref'] = $inputData['giico_job_ref'];
        $postData['client_ref_no'] = $inputData['client_ref_no'];
        $postData['client_email'] = $inputData['client_email'];
        $postData['department_id'] = $inputData['department'];
        $postData['country'] = $inputData['country'];
        $postData['is_allow_feedback'] = $inputData['is_allow_feedback'];
        $postData['is_report_check_mark'] = $inputData['is_report_check_mark'];
        $postData['update_times'] = 1;
        $postData['qr_token'] = $unique_token;
        
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $report_title = $postData['report_title'];
        $qry = $this->db->query("SELECT * FROM `reports` WHERE `report_title` = '$report_title'");
        $resData = $qry->row();
        if(empty($resData))
        {
            $report_id = $this->objcom->insert_and_return_id('reports',$postData);
            if($report_id)
            {
                $hist_report['report_id'] = $report_id;
                $hist_report['report_title'] = $inputData['report_title'];
                $hist_report['giico_job_ref'] = $inputData['giico_job_ref'];
                $hist_report['update_times'] = 1;
                $hist_report['expiry_date'] = $expiry_date;
                $hist_report['report_doc'] = $postData['report_doc'];
                $hist_report['create_date'] = date('Y-m-d');
                $this->objcom->insert_data('report_history',$hist_report);
                $governorateData = $this->objcom->get_single_record('governorates',array('nameUrl'=>$inputData['governorate']));
                if(!empty($governorateData)){
                    $postData['governorateName'] = $governorateData->name;
                }else{
                    $postData['governorateName'] = '';
                }
                $cityData = $this->objcom->get_single_record('cities',array('id'=>$inputData['cities']));
                if(!empty($cityData)){
                    $postData['cityName'] = $cityData->name;
                }else{
                    $postData['cityName'] = '';
                }
                $departmentData = $this->objcom->get_single_record('departments',array('id'=>$inputData['department']));
                if(!empty($departmentData)){
                    $postData['departmentName'] = $departmentData->name;
                }else{
                    $postData['departmentName'] = '';
                }
                $clientData = $this->objcom->get_single_record('customers',array('id'=>$inputData['client']));
                if(!empty($clientData)){
                    $postData['clientName'] = $clientData->customer_name;
                }else{
                    $postData['clientName'] = '';
                }
                $postData['giico_job_ref'] = $inputData['giico_job_ref'].'-'.'1';
                $postData['login_url'] = base_url('client-login');
                
                $res = $this->sendEmail($postData,$inputData['client_email']);
                if($res){
                    $responseData['responseData'] = "new record inserted successfully";  
                }
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	 
    
	function createReport_bck()
	{
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        //echo"<pre>";print_r($inputData);die;
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($inputData['report_date'])){
            $report_date = date('Y-m-d',strtotime($inputData['report_date']));
        }else{
            $report_date = date('Y-m-d');
        }
        
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            if(($_FILES['file']['type'] == 'application/pdf') || ($_FILES['file']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || ($_FILES['file']['type'] == 'text/csv')){ 
                $file = $this->objcom->updateMedia('file','reports','reports');
                $imagedata['image'] = $file;
            }else{
                $responseData['responseData'] = "report type"; 
                echo json_encode($responseData);
                die();
            }
            
            if(!empty($imagedata['image'])){
                $postData['report_doc'] = $imagedata['image'];
            }else{
                $postData['report_doc'] = 'default-image.png';
            }
        } else {
            $responseData['responseData'] = "No file uploaded";
            echo json_encode($responseData);
            die();
        }
        
        
        $expiry_date = date('Y-m-d', strtotime('+90 days', strtotime($report_date)));
        $report_url = base_url('uploads/reports/').$postData['report_doc'];
        $unique_token = md5(uniqid(rand(), true)); // Generate a unique token
        $validation_url = base_url('Welcome/validate_qr') . '?token=' . $unique_token;
        
        /*----- QR Code -----*/
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/images/';
        $logo_path = base_url('uploads/logo.jpg');
        $text = $validation_url;
        
        $folder = $SERVERFILEPATH;
        $file_name1 = date('dhis') . "qrcode.png";
        $file_name = $folder . $file_name1;
        $url_name = base_url('images/') . $file_name1;
        
        // Set the QR code size
        $QR_size = 4; // Adjust the size value for a larger QR code
        
        // Generate the QR code
        QRcode::png($text, $file_name, QR_ECLEVEL_H, $QR_size);
        
        // Load the QR code and the logo
        $QR = imagecreatefrompng($file_name);
        $logo = imagecreatefrompng($logo_path); // Use imagecreatefrompng for a PNG logo
        
        // Get dimensions of QR code and logo
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        
        // Increase the size of the logo
        $logo_scale_factor = 6; // Scale factor for resizing the logo (1: smaller, 5: larger)
        $logo_qr_width = (int)($QR_width / $logo_scale_factor);
        $logo_qr_height = (int)($QR_height / $logo_scale_factor);
        $logo_x = (int)(($QR_width - $logo_qr_width) / 2);
        $logo_y = (int)(($QR_height - $logo_qr_height) / 2);
        
        // Create a white background for the resized logo
        $logo_resized = imagecreatetruecolor($logo_qr_width, $logo_qr_height);
        $white = imagecolorallocate($logo_resized, 255, 255, 255);
        imagefill($logo_resized, 0, 0, $white);
        
        // Copy the logo onto the white background
        imagecopyresampled($logo_resized, $logo, 0, 0, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        
        // Merge the logo onto the QR code
        imagecopy($QR, $logo_resized, $logo_x, $logo_y, 0, 0, $logo_qr_width, $logo_qr_height);
        
        // Save the QR code with the logo
        imagepng($QR, $file_name);
        
        // Clean up
        imagedestroy($QR);
        imagedestroy($logo);
        imagedestroy($logo_resized);

        $postData['qr_image']= $file_name1;
        /*----- End ------*/
        $postData['company_name'] = $inputData['company_name'];
        $postData['report_date'] = $report_date;
        $postData['expiry_date'] = $expiry_date;
        $postData['client_id'] = $inputData['client'];
        $postData['report_title'] = $inputData['report_title'];
        $postData['governorateSlug'] = $inputData['governorate'];
        $postData['city_id'] = $inputData['cities'];
        $postData['address1'] = $inputData['address1'];
        $postData['address2'] = $inputData['address2'];
        $postData['giico_job_ref'] = $inputData['giico_job_ref'];
        $postData['client_ref_no'] = $inputData['client_ref_no'];
        $postData['client_email'] = $inputData['client_email'];
        $postData['department_id'] = $inputData['department'];
        $postData['country'] = $inputData['country'];
        $postData['is_allow_feedback'] = $inputData['is_allow_feedback'];
        $postData['is_report_check_mark'] = $inputData['is_report_check_mark'];
        $postData['update_times'] = 1;
        $postData['qr_token'] = $unique_token;
        
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $report_title = $postData['report_title'];
        $qry = $this->db->query("SELECT * FROM `reports` WHERE `report_title` = '$report_title'");
        $resData = $qry->row();
        if(empty($resData))
        {
            $report_id = $this->objcom->insert_and_return_id('reports',$postData);
            if($report_id)
            {
                $hist_report['report_id'] = $report_id;
                $hist_report['report_title'] = $inputData['report_title'];
                $hist_report['giico_job_ref'] = $inputData['giico_job_ref'];
                $hist_report['update_times'] = 1;
                $hist_report['expiry_date'] = $expiry_date;
                $hist_report['report_doc'] = $postData['report_doc'];
                $hist_report['create_date'] = date('Y-m-d');
                $this->objcom->insert_data('report_history',$hist_report);
                $governorateData = $this->objcom->get_single_record('governorates',array('nameUrl'=>$inputData['governorate']));
                if(!empty($governorateData)){
                    $postData['governorateName'] = $governorateData->name;
                }else{
                    $postData['governorateName'] = '';
                }
                $cityData = $this->objcom->get_single_record('cities',array('id'=>$inputData['cities']));
                if(!empty($cityData)){
                    $postData['cityName'] = $cityData->name;
                }else{
                    $postData['cityName'] = '';
                }
                $departmentData = $this->objcom->get_single_record('departments',array('id'=>$inputData['department']));
                if(!empty($departmentData)){
                    $postData['departmentName'] = $departmentData->name;
                }else{
                    $postData['departmentName'] = '';
                }
                $clientData = $this->objcom->get_single_record('customers',array('id'=>$inputData['client']));
                if(!empty($clientData)){
                    $postData['clientName'] = $clientData->customer_name;
                }else{
                    $postData['clientName'] = '';
                }
                $postData['giico_job_ref'] = $inputData['giico_job_ref'].'-'.'1';
                $postData['login_url'] = base_url('client-login');
                
                $res = $this->sendEmail($postData,$inputData['client_email']);
                if($res){
                    $responseData['responseData'] = "new record inserted successfully";  
                }
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	 
	function editReport($id)
    {
        $data_array['clients'] = $this->objcom->get_all_where('customers',array('status'=>1),$ord="id");
	    $data_array['governorates'] = $this->objcom->get_all_where('governorates',array('status'=>1),$ord="id");
	    $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
        $data_array['record'] = $this->objcom->get_single_record('reports',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/reports/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function updateReport()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $login_url = base_url('client-login');
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $id = $inputData['id'];
        $data_array = $this->objcom->get_single_record('reports',array('id'=>$id));
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            if(($_FILES['file']['type'] == 'application/pdf') || ($_FILES['file']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || ($_FILES['file']['type'] == 'text/csv')){ 
                $file = $this->objcom->updateMedia('file','reports','reports');
                $imagedata['image'] = $file;
            }else{
                $responseData['responseData'] = "report type"; 
                echo json_encode($responseData);
                die();
            }
            
            if(!empty($imagedata['image'])){
                $postData['report_doc'] = $imagedata['image'];
            }else{
                $postData['report_doc'] = $data_array->report_doc;
            }
        } else {
            $postData['report_doc'] = $data_array->report_doc;
        }
        
        $postData['company_name'] = $inputData['company_name'];
        $postData['report_date'] = date('Y-m-d',strtotime($inputData['report_date']));
        $postData['client_id'] = $inputData['client'];
        $postData['report_title'] = $inputData['report_title'];
        $postData['governorateSlug'] = $inputData['governorate'];
        $postData['city_id'] = $inputData['cities'];
        $postData['address1'] = $inputData['address1'];
        $postData['address2'] = $inputData['address2'];
        $postData['giico_job_ref'] = $inputData['giico_job_ref'];
        $postData['client_ref_no'] = $inputData['client_ref_no'];
        $postData['client_email'] = $inputData['client_email'];
        $postData['department_id'] = $inputData['department'];
        $postData['update_times'] = $data_array->update_times+1;
        $postData['country'] = $inputData['country'];
        $postData['is_allow_feedback'] = $inputData['is_allow_feedback'];
        $postData['is_report_check_mark'] = $inputData['is_report_check_mark'];
        
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        
        $expiry_date = date('Y-m-d', strtotime($data_array->expiry_date));
        $report_url = base_url('uploads/reports/').$postData['report_doc'];
        $unique_token = $data_array->qr_token; // Generate a unique token
        $validation_url = base_url('Welcome/validate_qr') . '?token=' . $unique_token;
        
        /*----- QR Code -----*/
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/gulf-inspection/images/';
        $logo_path = base_url('uploads/logo.jpg');
        $text = $validation_url;
        
        $folder = $SERVERFILEPATH;
        $file_name1 = date('dhis') . "qrcode.png";
        $file_name = $folder . $file_name1;
        $url_name = base_url('images/') . $file_name1;
        
        // Set the QR code size
        $QR_size = 4; // Adjust the size value for a larger QR code
        
        // Generate the QR code
        QRcode::png($text, $file_name, QR_ECLEVEL_H, $QR_size);
        
        // Load the QR code and the logo
        $QR = imagecreatefrompng($file_name);
        $logo = imagecreatefrompng($logo_path); // Use imagecreatefrompng for a PNG logo
        
        // Get dimensions of QR code and logo
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        
        // Increase the size of the logo
        $logo_scale_factor = 6; // Scale factor for resizing the logo (1: smaller, 5: larger)
        $logo_qr_width = (int)($QR_width / $logo_scale_factor);
        $logo_qr_height = (int)($QR_height / $logo_scale_factor);
        $logo_x = (int)(($QR_width - $logo_qr_width) / 2);
        $logo_y = (int)(($QR_height - $logo_qr_height) / 2);
        
        // Create a white background for the resized logo
        $logo_resized = imagecreatetruecolor($logo_qr_width, $logo_qr_height);
        $white = imagecolorallocate($logo_resized, 255, 255, 255);
        imagefill($logo_resized, 0, 0, $white);
        // Copy the logo onto the white background
        imagecopyresampled($logo_resized, $logo, 0, 0, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        
        // Merge the logo onto the QR code
        imagecopy($QR, $logo_resized, $logo_x, $logo_y, 0, 0, $logo_qr_width, $logo_qr_height);
        
        // Save the QR code with the logo
        imagepng($QR, $file_name);
        
        //Clean up
        imagedestroy($QR);
        imagedestroy($logo);
        imagedestroy($logo_resized);
        
        // generating padf and insert qr code to each page ----
        
        $qrcodeimage = FCPATH . "images/".$file_name1;
        $templateFile = FCPATH . "uploads/reports/".$postData['report_doc']; // Path to your existing PDF

        // Check if the file exists
        if (!file_exists($templateFile)) {
            show_error('Template file does not exist: ' . $templateFile);
        }

        // Initialize FPDI
        $pdf = new FPDI();
        $pageCount = $pdf->setSourceFile($templateFile);

        // Loop through each page of the template
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // Import a page
            $tplIdx = $pdf->importPage($pageNo);

            // Add a page
            $pdf->AddPage();

            // Use the imported page as the template
            $pdf->useTemplate($tplIdx);

            // Get the size of the imported page
            $size = $pdf->getTemplateSize($tplIdx);

            // Define QR code dimensions
            $qrWidth = 35; // Width of the QR code
            $qrHeight = 35; // Height of the QR code

            if ($pageNo == 1) {
                $qrWidth = 40; // Width of the QR code
                $qrHeight = 40; // Height of the QR code
                // Position for the first page: centered in the middle
                $x = ($size['width'] - $qrWidth) / 12;
                $y = ($size['height'] - $qrHeight) / 1.7;

                // Add QR code image to the first page
                $pdf->Image($qrcodeimage, $x, $y, $qrWidth, $qrHeight);

                // Add text below the QR code on the first page
                $pdf->SetFont('Arial', '', 12);
                $pdf->SetXY($x, $y + $qrHeight + 5); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
                $pdf->Ln();
                $pdf->SetXY($x, $y + $qrHeight + 15); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
            } else {
                // Position for all other pages: centered at the bottom
                $x = ($size['width'] - $qrWidth) / 2;
                $y = $size['height'] - $qrHeight - -15; // Adjust the value to fit your needs

                // Add QR code image to the other pages
                $pdf->Image($qrcodeimage, $x, $y, $qrWidth, $qrHeight);

                // Add text above the QR code on the other pages
                $pdf->SetFont('Arial', '', 12);
                $pdf->SetXY($x, $y - 15); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
                $pdf->Ln();
                $pdf->SetXY($x, $y - 5); // Adjust position as needed
                $pdf->Cell($qrWidth, 10, "", 0, 0, 'C');
            }
        }
        // Output the new PDF
        $outputFile = FCPATH . "uploads/reports/".$postData['report_doc'];
        $pdf->Output($outputFile, "F");
        //echo "Done generating QR Code PDF.";die;

        // =====END===
        
        $postData['qr_image']= $file_name1;
        $report_title = $postData['report_title'];
        
        $qry = $this->db->query("SELECT * FROM `reports` WHERE `report_title` = '$report_title' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('reports',$postData,$where=array('id'=>$id)))
            {
                $hist_report['report_id'] = $id;
                $hist_report['report_title'] = $inputData['report_title'];
                $hist_report['giico_job_ref'] = $inputData['giico_job_ref'];
                $hist_report['update_times'] = $data_array->update_times+1;
                $hist_report['report_doc'] = $postData['report_doc'];
                $hist_report['create_date'] = date('Y-m-d');
                $this->objcom->insert_data('report_history',$hist_report);
                
                $governorateData = $this->objcom->get_single_record('governorates',array('nameUrl'=>$inputData['governorate']));
                if(!empty($governorateData)){
                    $postData['governorateName'] = $governorateData->name;
                }else{
                    $postData['governorateName'] = '';
                }
                $cityData = $this->objcom->get_single_record('cities',array('id'=>$inputData['cities']));
                if(!empty($cityData)){
                    $postData['cityName'] = $cityData->name;
                }else{
                    $postData['cityName'] = '';
                }
                $departmentData = $this->objcom->get_single_record('departments',array('id'=>$inputData['department']));
                if(!empty($departmentData)){
                    $postData['departmentName'] = $departmentData->name;
                }else{
                    $postData['departmentName'] = '';
                }
                $clientData = $this->objcom->get_single_record('customers',array('id'=>$inputData['client']));
                if(!empty($clientData)){
                    $postData['clientName'] = $clientData->customer_name;
                }else{
                    $postData['clientName'] = '';
                }
                $postData['giico_job_ref'] = $inputData['giico_job_ref'].'-'.$data_array->update_times+1;
                $postData['login_url'] = $login_url;
                $postData['qr_image']= $postData['qr_image'];
                
                $res = $this->sendEmail($postData,$inputData['client_email']);
                if($res){
                    $responseData['responseData'] = "record updated successfully"; 
                }
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    function viewReport($id)
    {
        $data_array['clients'] = $this->objcom->get_all_where('customers',array('status'=>1),$ord="id");
	    $data_array['governorates'] = $this->objcom->get_all_where('governorates',array('status'=>1),$ord="id");
	    $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
        $data_array['record'] = $this->objcom->get_single_record('reports',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/reports/view',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    function reportHistory($id)
    {
	    $data_array['records'] = $this->objcom->get_all_where('report_history',array('report_id'=>$id),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/reports/history',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    public function sendEmail($postData,$email)
    {
        /*php Mailer Configuration*/
        $email_data = $this->load->view('Emails/email-template',$postData,TRUE);
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
    function get_cities()
    {
        $governorate = $this->input->post('governorate');
        $data_array['id'] = $this->input->post('id');
        $data_array['records'] = $this->objcom->get_all_where('cities',array('governorateSlug'=>$governorate),"id");
        $html = $this->load->view('ADMIN/ajax/cities',$data_array,TRUE);
        $respone['response'] = $html;
        echo json_encode($respone);
    }
    function get_clients_email()
    {
        $client_id = $this->input->post('client_id');
        $data_array['id'] = $this->input->post('id');
        $records = $this->objcom->get_single_record('customers',array('id'=>$client_id),"id");
        if(!empty($records)){
            $respone['response'] = $records->email;;
        }
        echo json_encode($respone);
    }
    
    public function client_import(){
        $data = array();
        $memData = array();
        // If import request is submitted
        if($this->input->post('importSubmit')){
            //echo"<pre>";print_r('okay');die;
            //Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            //echo"<pre>";print_r($this->form_validation->run());die;
            // Validate submitted form data
            if($this->form_validation->run() == true){
                //echo"<pre>";print_r('okay');die;
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            
                            // Prepare data for DB insertion
                            $memData = array(
                                'customer_name' => $row['Client_Name'],
                                'company_name' => $row['Company_Name'],
                                'email' => $row['Email'],
                                'mobile_number' => $row['Phone'],
                                'password' => md5($row['Password']),
                                'status' => $row['Status'],
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'email' => $row['Email']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->objcom->getRows('customers',$con);
                            //echo"<pre>";print_r($prevCount);die;
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('email' => $row['Email']);
                                $update = $this->objcom->update('customers', $memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->objcom->insert('customers', $memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('customers-list');
    }
    public function governorate_import(){
        $data = array();
        $memData = array();
        // If import request is submitted
        if($this->input->post('importSubmit')){
            //Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            // Validate submitted form data
            if($this->form_validation->run() == true){
                //echo"<pre>";print_r('okay');die;
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            $postData['nameUrl'] = $this->removeSpecialChapr($row['Name']);
                            $url = $postData['nameUrl'];
                            // Prepare data for DB insertion
                            $memData = array(
                                'name' => $row['Name'],
                                'nameUrl' => $url,
                                'status' => 1,
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'name' => $row['Name']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->objcom->getRows('governorates',$con);
                            //echo"<pre>";print_r($prevCount);die;
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('name' => $row['Name']);
                                $update = $this->objcom->update('governorates', $memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->objcom->insert('governorates', $memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('governorate-list');
    }
    public function city_import(){
        $data = array();
        $memData = array();
        // If import request is submitted
        if($this->input->post('importSubmit')){
            //Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            // Validate submitted form data
            if($this->form_validation->run() == true){
                //echo"<pre>";print_r('okay');die;
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            $postData['nameUrl'] = $this->removeSpecialChapr($row['Name']);
                            $url = $postData['nameUrl'];
                            // Prepare data for DB insertion
                            $memData = array(
                                'name' => $row['Name'],
                                'nameUrl' => $url,
                                'governorateSlug' => $row['GovernorateSlug'],
                                'status' => 1,
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'name' => $row['Name'],
                                    'governorateSlug' => $row['GovernorateSlug']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->objcom->getRows('cities',$con);
                            //echo"<pre>";print_r($prevCount);die;
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('name' => $row['Name']);
                                $update = $this->objcom->update('cities', $memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->objcom->insert('cities', $memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('city-list');
    }
    public function department_import(){
        $data = array();
        $memData = array();
        // If import request is submitted
        if($this->input->post('importSubmit')){
            //Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            // Validate submitted form data
            if($this->form_validation->run() == true){
                //echo"<pre>";print_r('okay');die;
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    $this->load->library('CSVReader');
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            $postData['nameUrl'] = $this->removeSpecialChapr($row['Name']);
                            $url = $postData['nameUrl'];
                            // Prepare data for DB insertion
                            $memData = array(
                                'name' => $row['Name'],
                                'nameUrl' => $url,
                                'status' => 1,
                            );
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'name' => $row['Name'],
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->objcom->getRows('departments',$con);
                            //echo"<pre>";print_r($prevCount);die;
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('name' => $row['Name']);
                                $update = $this->objcom->update('departments', $memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->objcom->insert('departments', $memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Members imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('departments');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
    /*-------------------QR Code generate --------------------*/

    public function qrcode(){
        $data_array['record'] = $this->objcom->get_single_record('qrcode',array('id'=>1));
        $this->load->view('admin/include/header');
		$this->load->view('admin/qrcode/edit',$data_array);
		$this->load->view('admin/include/footer');
    }
    function userList()
    {
        $reco = $this->objcom->get_all_where('admin',array('user_type'=>2),$ord="id");
        if(!empty($reco)){
            foreach($reco as $key=>$rec){
                $department = $rec->department;
                $dept_data = $this->objcom->get_single_record('departments',array('id'=>$department));
                if(!empty($dept_data)){
                    $rec->dept_name = $dept_data->name;
                }else{
                    $rec->dept_name = "";
                }
            }
        }
        $data_array['records'] = $reco;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub_admin/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    function add_new_user()
	{
	    $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub_admin/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	function create_new_user()
	{
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        
        $postData['name'] = $inputData['name'];
        $postData['email'] = $inputData['email'];
        $postData['phone'] = $inputData['phone'];
        $postData['password'] = ($inputData['password']);
        $postData['department'] = $inputData['department'];
        $postData['user_type'] = 2;
        $modules = $inputData['modules'];
        $permissions = $inputData['permissions'];
        
        $email = $postData['email'];
        $qry = $this->db->query("SELECT * FROM `admin` WHERE `email` = '$email'");
        $resData = $qry->row();
        if(empty($resData))
        {
            $subadmin_id = $this->objcom->insert_and_return_id('admin',$postData);
            if($subadmin_id)
            {
                // Insert permissions
                if ($modules && $permissions) {
                    foreach ($modules as $moduleId) {
                        $read = isset($permissions[$moduleId]['read']) ? 1 : 0;
                        $write = isset($permissions[$moduleId]['write']) ? 1 : 0;
                        $delete = isset($permissions[$moduleId]['delete']) ? 1 : 0;
                        $permitData['user_id'] = $subadmin_id;
                        $permitData['module_id'] = $moduleId;
                        $permitData['read_ope'] = $read;
                        $permitData['write_ope'] = $write;
                        $permitData['delete_ope'] = $delete;
                        $this->objcom->insert_data('permissions',$permitData);
                    }
                }
                $responseData['responseData'] = "new record inserted successfully";        
            }
            
        }else{
            
            $responseData['responseData'] = "email already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	function edit_user($id)
    {
        $data_array['departments'] = $this->objcom->get_all_where('departments',array('status'=>1),$ord="id");
        $data_array['record'] = $this->objcom->get_single_record('admin',array('id'=>$id));
        $permissions = $this->objcom->get_all_where('permissions',array('user_id'=>$id),'');
        // Create an array to easily check permissions in the view
        $permissions_array = [];
        $modules = [];
        $permission_ids = [];
        foreach ($permissions as $key=>$permission) {
            $modules[$key] = $permission->module_id;
            $permission_ids[$key] = $permission->id;
            $permissions_array[$permission->module_id] = [
                'read' => $permission->read_ope,
                'write' => $permission->write_ope,
                'delete' => $permission->delete_ope,
                'permit_id' => $permission->id
            ];
        }
        //echo"<pre>";print_r($permissions_array);die;
        $data_array['modules'] = $modules;
        $data_array['permissions'] = $permissions_array;
        $data_array['permission_ids'] = $permission_ids;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub_admin/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function update_user()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $id = $inputData['id'];
        $data_array = $this->objcom->get_single_record('admin',array('id'=>$id));
        //echo"<pre>";print_r($inputData);die;
        $postData['name'] = $inputData['name'];
        $postData['email'] = $inputData['email'];
        $postData['phone'] = $inputData['phone'];
        $postData['department'] = $inputData['department'];
        $email = $postData['email'];
        $modules = $inputData['modules'];
        $permissions = $inputData['permissions'];
        
        $permission_data = $this->objcom->get_all_where('permissions',array('user_id'=>$id),'');
        // Create an array to easily check permissions in the view
        $permission_ids = [];
        foreach ($permission_data as $key=>$permission) {
            $permission_ids[$key] = $permission->id;
        }
        
        $qry = $this->db->query("SELECT * FROM `admin` WHERE `email` = '$email' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('admin',$postData,$where=array('id'=>$id)))
            {
                #$this->objcom->delete_record('permissions',array('user_id'=>$id));
                if ($modules && $permissions) {
                    foreach ($modules as $moduleId) {
                        $read = isset($permissions[$moduleId]['read']) ? 1 : 0;
                        $write = isset($permissions[$moduleId]['write']) ? 1 : 0;
                        $delete = isset($permissions[$moduleId]['delete']) ? 1 : 0;
                        $permit_id = isset($permissions[$moduleId]['permit_id']) ? $permissions[$moduleId]['permit_id'] : '';
                        $permitData['user_id'] = $id;
                        $permitData['module_id'] = $moduleId;
                        $permitData['read_ope'] = $read;
                        $permitData['write_ope'] = $write;
                        $permitData['delete_ope'] = $delete;
                        
                        if($permit_id){
                            $this->objcom->update_records('permissions',$permitData,$where=array('id'=>$permit_id));
                        }else{
                            $this->objcom->insert_data('permissions',$permitData);
                        }

                    }
                }
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "email already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    
    
    
    
    public function qrcodeGenerator (){
        $inputData = $this->input->post();
        
        $name = $inputData['title'];
        $url = $inputData['url'];
        $dataInfo = $this->objcom->get_single_record('qrcode',array('id'=>1));
        if(!empty($name))
        {
            //echo"<pre>";print_r($name);exit;
            $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/coffeeday/images/';
            $text = $name.'#### '.$url;
            $text1= substr($text, 0,9);
            
            $folder = $SERVERFILEPATH;
            //$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
            
                $file_name1 = $name."qrcode".".png";
                $file_name = $folder.$file_name1;
                $url_name = base_url('images/').$file_name1;
                //echo "<pre>";print_r($file_name1);exit;
                QRcode::png($text,$file_name);
                
                $userData['name']= $name;
                $userData['url']= $url;
                $userData['image']= $file_name1;
                $this->objcom->update_records('qrcode',$userData,array('id'=>1));
                ######### Email ############
                //  $config['protocol'] = 'sendmail';
                //  $config['smtp_host']    = 'ssl://smtp.googlemail.com';
                //  $config['smtp_port']    = '587';
                //  $config['smtp_user']    = 'bfcocomatin@gmail.com';
                //  $config['smtp_pass']    = 'BFcoco12345';
                //  $config['charset']    = 'utf-8';
                //  $config['newline']    = "\r\n";
                //  $config['mailtype'] = 'html';
                //  $config['validation'] = TRUE; 
             
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $email_id = 'shankar.wxit@gmail.com';
                $data['name'] = $name;
                $data['qr_code'] = $file_name1;
                $data['url'] = $url;
               
                $this->email->from('shankar.wxit@gmail.com', 'COFFEEDAY');
               
                $body = $this->load->view('emails/email_template',$data,TRUE);
                $this->email->to($email_id);
                $this->email->subject('QRCode Generation');
                $this->email->message($body);
                if($this->email->send())
                {
                    $response['response'] = 'Record Updated';  
                }
           
        }
        else
        {
            echo 'No Text Entered';
        } 
        echo json_encode($response);
        die();
    }
   
	
/*MAin Class Ended*/	
}
