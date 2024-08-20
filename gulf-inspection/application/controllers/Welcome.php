<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kuwait');
        $this->load->model('common','objcom');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		redirect('admin-login');
	}
	function privacy_policy()
    {
        $this->load->view('privacy_policy');
    }
    
    // public function validate_qr() {
    //     $token = $this->input->get('token');
    
    //     if ($token) {
    //         // Fetch the token details from the database
    //         $this->db->where('qr_token', $token);
    //         $qr_code = $this->db->get('reports')->row();
    
    //         if ($qr_code) {
    //             $current_date = date('Y-m-d');
    
    //             if ($current_date > $qr_code->expiry_date) {
    //                 $data['message'] = "This QR code has expired.";
    //             } else {
    //                 $data['report_url'] = base_url('Welcome/view_pdf') . '?token=' . $token;
    //                 $data['message'] = "Redirecting...";
    //             }
    //         } else {
    //             $data['message'] = "Invalid QR code.";
    //         }
    //     } else {
    //         $data['message'] = "Invalid QR code.";
    //     }
    
    //     $this->load->view('validate_qr', $data);
    // }
    
    // public function view_pdf() {
    //     $token = $this->input->get('token');
    
    //     if ($token) {
    //         // Fetch the token details from the database
    //         $this->db->where('qr_token', $token);
    //         $qr_code = $this->db->get('reports')->row();
    
    //         if ($qr_code) {
    //             $current_date = date('Y-m-d');
    //             $report_url = base_url('uploads/reports/').$qr_code->report_doc;
    //             if ($current_date <= $qr_code->expiry_date) {
    //                 // Serve the PDF file in a viewer
    //                 $data['pdf_url'] = $report_url;
    //                 $this->load->view('pdf_viewer', $data);
    //                 return;
    //             }
    //         }
    //     }
    //     echo "Access denied.";
    // }
    
    public function validate_qr() {
        $token = $this->input->get('token');
    
        if ($token) {
            // Fetch the token details from the database
            $this->db->where('qr_token', $token);
            $qr_code = $this->db->get('reports')->row();
    
            if ($qr_code) {
                $current_date = date('Y-m-d');
    
                if ($current_date > $qr_code->expiry_date) {
                    $data['message'] = "This QR code has expired.";
                } else {
                    if ($qr_code->is_report_check_mark == 1) {
                        $data['auth_required'] = true;
                        $data['report_url'] = base_url('Welcome/authenticate') . '?token=' . $token;
                        $data['message'] = "Authentication required...";
                    } else {
                        $data['report_url'] = base_url('Welcome/view_pdf') . '?token=' . $token;
                        $data['message'] = "Redirecting...";
                    }
                }
            } else {
                $data['message'] = "Invalid QR code.";
            }
        } else {
            $data['message'] = "Invalid QR code.";
        }
    
        $this->load->view('validate_qr', $data);
    }
    public function authenticate() {
        $token = $this->input->get('token');
        $data['token'] = $token;
        $this->load->view('authenticate', $data);
    }
    
    public function validate_password() {
        $token = $this->input->post('token');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
    
        // Fetch the token details from the database
        $this->db->where('qr_token', $token);
        $qr_code = $this->db->get('reports')->row();
    
        if ($qr_code) {
            $client_id = $qr_code->client_id;
            $user_data = $this->objcom->get_single_record('customers',array('id'=>$client_id));
            if($email == $user_data->email && (md5($password) == $user_data->password)){
            // if (password_verify($password, $qr_code->user_password)) { // Assuming passwords are hashed
                $data['report_url'] = base_url('Welcome/view_pdf') . '?token=' . $token;
                $data['message'] = "Authentication successful. Redirecting...";
            } else {
                $data['message'] = "Invalid password. Please try again.";
                $data['token'] = $token;
                $this->load->view('authenticate', $data);
                return;
            }
            
        } else {
            $data['message'] = "Invalid QR code.";
        }
    
        $this->load->view('validate_qr', $data);
    }
    public function view_pdf() {
        $token = $this->input->get('token');
    
        if ($token) {
            // Fetch the token details from the database
            $this->db->where('qr_token', $token);
            $qr_code = $this->db->get('reports')->row();
    
            if ($qr_code) {
                $current_date = date('Y-m-d');
                $report_url = base_url('uploads/reports/') . $qr_code->report_doc;
    
                if ($current_date <= $qr_code->expiry_date) {
                    $data['pdf_url'] = $report_url;
                    $data['downloadable'] = ($qr_code->is_report_check_mark == 2);
                    $data['printable'] = ($qr_code->is_report_check_mark == 3);
                    $this->load->view('pdf_viewer', $data);
                    return;
                }
            }
        }
        echo "Access denied.";
    }




    
}
