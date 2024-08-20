<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;
 
class Api extends CI_Controller 
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->library('curl');
        $this->load->model("Common", "objcom");
        //date_default_timezone_set('Asia/Kuwait');
        date_default_timezone_set('Asia/Kolkata');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    function default_file(){
        header("Access-Control-Allow-Origin: * ");
        header("Access-Control-Allow-Headers: Origin,Content-Type ");
        header("Content-Type:application/json ");
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json,true);
    }
    public function urlList(){
        $responseData=array(); 
        $responseArray=array();
        $data_array = $this->objcom->get_all_where('url_cms',array('status'=>1),'id');
        
        if($data_array){
              $responseArray = array(
                'apiName' => 'URL List',
                'version' => '1.0.0',
                'status'=>true,
                'responseCode' => 200,
                'responseMessage' => 'Data Found',
                'responseData' => $data_array
            ); 
            
        }else{
              
              $responseArray = array(
                'apiName' => 'URL List',
                'version' => '1.0.0',
                'status'=>false,
                'responseCode' => 500,
                'responseMessage' => 'Data Not Found!',
                'responseData' => $data_array
            ); 
        }
        echo  json_encode($responseArray);
    }
   
    
    
    
    
    
    
    
    
    
    
 
    
}