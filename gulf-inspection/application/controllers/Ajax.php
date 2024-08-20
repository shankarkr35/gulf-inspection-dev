<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
    public function __construct()
    { 
        date_default_timezone_set('Asia/Kuwait');
        parent::__construct();
        $this->load->model('common','objcom');
    }

    function infinite_scroll()
    {
        $inputs = $this->input->post();  
        $start = $inputs['start'];
        $limit = $inputs['limit']; 
        $startp = '';
        if($start!=0){
            $startp = $start.",";
        }else{
            $startp = '';
        }
        $products_array['records'] = $this->objcom->get_infinite_products($startp,$limit);
        $html = $this->load->view('FRONT/ajax/infinite-products',$products_array,TRUE);
        $output = array(
            'counts'  => count($products_array['records']),
            'products'   => $html
        );
        echo json_encode($output);
        die();
    }
    
    
    function products_filter()
    {
        $inputs = $this->input->post();
        //echo"<pre>";print_r($inputs);die;
        $categories_url = $inputs['categories'];
        $scategories_url = $inputs['scats'];
        $cat_array = $this->objcom->get_single_record('categories',array('nameUrl'=>$categories_url));
        $sub_cat_array = $this->objcom->get_single_record('sub_categories',array('name_url'=>$scategories_url));
        $categories = "";
        if(!empty($cat_array)){
            $categories = $cat_array->id;
        }else{
            $categories = '';
        }
        $scategories = "";
        if(!empty($sub_cat_array)){
            $scategories = $sub_cat_array->id;
        }else{
            $scategories = '';
        }
        
        $childcategories = $inputs['childcat'];
        $brands = $inputs['brands'];
        $sizes = "";
        $colors = "";
      
        $startp = '';
        $keyword = $inputs['keyword'];
        $ptypes = $inputs['ptypes'];
        $page = $inputs['page'];
        
        $this->load->library("pagination");

		$config = array();
        //$countdata = $this->objcom->count_all($categories,$scategories,$childcategories,$brands,$inputs['min_price'],$inputs['max_price'],$ptypes);
    
		$config["base_url"] = "#";
		$config["total_rows"] = $this->objcom->count_all($categories,$scategories,$childcategories,$brands,$inputs['min_price'],$inputs['max_price'],$ptypes,$keyword);
        $config['per_page'] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        //$config['first_link'] = '<i class="icon-angle-double-left doubleLeft page-link page-link-btn"></i>';
        //$config['last_link'] = '<i class="icon-angle-double-right doubleRight page-link page-link-btn"></i>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];
        
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
       
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link page-link-btn">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item page-link-btn">';
        $config['num_tag_close'] = '</li>';
      
		$config["num_links"] = 5;
		$this->pagination->initialize($config);
		if(!empty($page)){
		    $page = $page;
		}else{
		    $page = 1;
		}
		
		
	
		$start = ($page - 1) * $config["per_page"];
        $products_array['records'] = $this->objcom->get_filtered_products($config["per_page"],$start,$categories,$scategories,$childcategories,$brands,$inputs['min_price'],$inputs['max_price'],$ptypes,$keyword);
        //echo"<pre>";print_r($products_array['records']);die; 
        $html = $this->load->view('Front/ajax/product-filter',$products_array,TRUE);
        $output = array(
            //'counts'  => count($products_array['records']),
            'products'   => $html,
            'pagination_link' =>	$this->pagination->create_links(),
            'query' => ''
         );
         echo json_encode($output);
         die();
    }

    function get_variation_size()
    {
        $lang = $this->session->userdata('site_lang');
        $inputs = $this->input->post();
        $data_array['size_id'] = $inputs['size'];
        $product_id = $inputs['product'];
        $variation_id = $inputs['variation'];
        $data_array['record'] = $this->common->get_single_record('product_variations',array('id'=>$variation_id));
        $data_array['records'] = $this->objcom->get_all_where('product_size_price',array('product_id'=>$product_id,'variation_id'=>$variation_id),'id');
        $html = $this->load->view('FRONT/ajax/size-list',$data_array,TRUE);
        $gallerhtml = $this->load->view('FRONT/ajax/gallery',$data_array,TRUE);
        $outputs = array(
           'size_list'  => $html,
           'gallery' =>$gallerhtml 
        );
        echo json_encode($outputs);
        die();
    }
    
    function get_product_price()
    {
        $lang = $this->session->userdata('site_lang');
        $inputs = $this->input->post();
        $size_id = $inputs['size'];
        $data = $this->objcom->get_single_record('product_size_price',array('id'=>$size_id));
        $data_array['record'] = $data;
        $cart_btn = $this->load->view('FRONT/ajax/cart-buttons',$data_array,TRUE);
        $wish_btn = $this->load->view('FRONT/ajax/wish-button',$data_array,TRUE);
        $outputs = array(
           'cart_button'  => $cart_btn,
           'wish_button'  => $wish_btn,
           'mrp'=>$data->mrp,
           'sale'=>(($data->sale!=0.000)?$data->sale:$data->mrp),
           'mrp'=>(($data->mrp!=0.000&&$data->sale!=0.000)?'KD '.$data->mrp:''),
           'product_id'=>$data->product_id,
           'variation_id'=>$data->variation_id,
           'psp_id'=>$data->id,
           'quantity'=>$data->quantity
        );
        echo json_encode($outputs);
        die();
    }
    function wish_list_controlls()
    {
        $date_time = date('Y-m-d H:i:s');
        $user_sess = $this->session->userdata('user_session'); 
        $inputs = $this->input->post();
	    $wishlist_arr['user_id'] = $user_sess['user_id'];
	    $wishlist_arr['product_id'] = $inputs['product_id'];
        $wishlist_arr['variation_id'] = $inputs['variation_id'];
        $wishlist_arr['size_id'] = $inputs['size_id'];
        $wishlist_arr['create_date'] = $date_time;
        $where = array('user_id'=>$user_sess['user_id'],'product_id'=>$inputs['product_id'],'variation_id'=>$inputs['variation_id'],'size_id'=>$inputs['size_id']);
        $data = $this->common->get_single_record('customers_wishlist',$where);
        if(!empty($data))
        {
            if($this->common->delete_record('customers_wishlist',array('id'=>$data->id)))
            {
                $res = 'removed';    
            }    
        }else{
            if($this->common->insert_data('customers_wishlist',$wishlist_arr))
            {
                $res = 'added';    
            }
        }
	    $outputs = array(
           'response' =>$res
        ); 
	    echo json_encode($outputs);
        die();
    }
    
    function add_to_cart()
    {
        $res = "";
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $user_type = $user_sess['type'];
        $inputs = $this->input->post();
	    $cart_data['user_id'] = $user_sess['user_id'];
	    $cart_data['user_type'] = $user_sess['type'];
	    $cart_data['product_id'] = $inputs['product_id'];
        
        $cart_data['quantity'] = $inputs['quantity'];

        //echo"<pre>";print_r($cart_data);die;
        $where = array('user_id'=>$user_id,'user_type'=>$user_type,'product_id'=>$inputs['product_id']);
        $checkdata = $this->objcom->get_single_record('user_cart',$where);
        if(empty($checkdata)){
            if($this->objcom->insert_data('user_cart',$cart_data))
            {
                $res='added to cart';   
            }else{
                $res = "something went wrong";   
            }  
            
        }else{
            $res='added to cart';
        }
        $where1 = array('user_id'=>$user_id,'user_type'=>$user_type);
        $cart_total = $this->objcom->get_all_where('user_cart',$where1,'id');
        $this->data['cartTotalitems'] = count($cart_total);
	    $outputs = array(
            'response' => $res,
            'total_items' =>count($cart_total)
        ); 
	    echo json_encode($outputs);
        die();
    }
    
    function load_cart_items()
    { 
        $arrayTotal = array();
        $lang = $this->session->userdata('site_lang');
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $user_type = $user_sess['type'];  
        $where = array('user_id'=>$user_id,'user_type'=>$user_type);
        $cart_array = $this->objcom->get_cart_products($user_id,$user_type);
        //echo"<pre>";print_r($cart_array);die;
        $data_array['records'] = $cart_array;
        $records =  $this->load->view('FRONT/ajax/cart-items',$data_array,TRUE);
        if(!empty($cart_array)){
            foreach($cart_array as $row){
                if (!empty($row) && is_object($row)) {
                    if(isset($row->sale) && $row->sale != 0.00) {
                        $arrayTotal[] = $row->sale * $row->cart_quantity;
                    } else {
                        $arrayTotal[] = $row->mrp * $row->cart_quantity;
                    }
                    
                } else {
                    // Handle the case when $row is not valid
                    // For example:
                    // $arrayTotal[] = 0; // or any default value you prefer
                }
            }
        }
        $outputs = array(
            'items' =>$records,
            'price' =>'AED '.number_format(array_sum($arrayTotal), 2)
        );
        echo json_encode($outputs);
        die();
    }

    function update_cart_quantity()
    {
        $res = '';
        $inputs = $this->input->post();
        //echo"<pre>";print_r($inputs);die;
        $product = $this->objcom->get_single_record('products',array('id'=>$inputs['product_id']));
        if(100 >= $inputs['quantity'])
        {
            $post['quantity'] = $inputs['quantity'];
            if($this->objcom->update_records('user_cart',$post,array('id'=>$inputs['cart_id']))){
                $res = 'updated';
            }else{
                $res = 'something wrong';   
            }
        }else{
            $res = 'out of stock';
        }
        $outputs = array(
            'response' =>$res,
        );
        echo json_encode($outputs);
        die();
    }
    
    function remove_cart_items()
    { 
        $res = '';
        $cart_id = $this->input->post('cart_id');  
        $where = array('id'=>$cart_id);
        if($this->objcom->delete_record('user_cart',$where))
        {
            $res = 'removed';    
        }else{
            $res = 'something wrong';
        }
        $userdata = $this->session->userdata('user_session');
        $wherecart = array('user_id'=>$userdata['user_id'],'user_type'=>$userdata['type']);
        $user_cart_data = $this->objcom->get_all_where('user_cart',$wherecart,'id');
        $outputs = array(
            'response' =>$res,
            'items'=>count($user_cart_data)
        );
        echo json_encode($outputs);
        die();
    }

    function get_customer_wishlist()
    {
        $user_sess = $this->session->userdata('user_session'); 
        $lang = $this->session->userdata('site_lang');
        $user_id = $user_sess['user_id'];
        $data_array['records'] = $this->objcom->wish_list_products($user_id);
        $html = $this->load->view('FRONT/ajax/wish-list-items',$data_array,TRUE);
        $outputs = array(
           'response' =>$html
        );
        echo json_encode($outputs);
        die();   
    }

    function move_to_cart()
    {
        $res = "";
        $user_sess = $this->session->userdata('user_session');
        $user_id = $user_sess['user_id'];
        $inputs = $this->input->post();
        $id = $product = $inputs['wish_id'];
        $product = $inputs['product'];
        $variation = $inputs['variation'];
        $size = $inputs['size'];
        $check_cart = check_product_incart($user_id,'user',$product,$variation,$size);
        if($check_cart==0){
            $cart_data['user_id'] = $user_id;
            $cart_data['user_type'] = 'user';
            $cart_data['product_id'] = $product;
            $cart_data['variation_id'] = $variation;
            $cart_data['quantity'] = 1;
            $cart_data['sizes'] = $size;
            if($this->objcom->insert_data('user_cart',$cart_data)){
                if($this->objcom->delete_record('customers_wishlist',array('id'=>$id))){
                    $res = 'moved';
                } 
            }
        }else{
            if($this->objcom->delete_record('customers_wishlist',array('id'=>$id))){
                $res = 'moved';
            }
        }  
        $where = array('user_id'=>$user_id,'user_type'=>'user');
        $cart_total = $this->common->get_all_where('user_cart',$where,'id');
        $this->data['cartTotalitems'] = count($cart_total);
        $outputs = array(
            'response' =>$res,
            'total_items'=>count($cart_total)
         );
         echo json_encode($outputs);
         die();
    }

    function remove_wishlist()
    {
        $res = "";
        $inputs = $this->input->post();
        $id = $product = $inputs['wish_id'];
        if($this->objcom->delete_record('customers_wishlist',array('id'=>$id))){
            $res = 'removed';
        }else{
            $res = 'something wrong';
        } 
        $outputs = array(
            'response' =>$res
         );
         echo json_encode($outputs);
         die();    
    }
    
    function apply_coupon_code()
    {
        $user_sess = $this->session->userdata('user_session'); 
        $res = '';
        $code = $this->input->post('coupon_code');
        $where = array('coupon_name'=>$code);
        $coupo_arr = $this->objcom->get_single_record('coupons_table',$where);
        
        if(!empty($coupo_arr))
        {
            $user_id = $user_sess['user_id'];
            $user_type = $user_sess['type'];
            $cart_total = $this->objcom->get_cart_products($user_id,$user_type);
            $arrayTotal = array();
            foreach($cart_total as $key=>$row)
            {
                if($row->sale!=0.000){
                    $arrayTotal[] = $row->sale*$row->cart_quantity; 
                }else{
                    $arrayTotal[] = $row->mrp*$row->cart_quantity; 
                }  
            }
            $cardTotalData = number_format(array_sum($arrayTotal), 2);
            $total_price = str_replace(",","",$cardTotalData);
            if($coupo_arr->status!=0)
            {
                $today = date('Y-m-d');
                $coupon_exp_date = $coupo_arr->coupon_expiry;
                if($today > $coupon_exp_date)
                {
                    $res = 'Coupon Code Expired';    
                }else{
                    $coupon_type = $coupo_arr->coupon_type;
                    $coupon_value = $coupo_arr->coupon_value;
                    if($coupon_type=='Flat')
                    {
                        if($total_price > $coupon_value){
                            $discount = $total_price-$coupon_value; 
                            $coupon_price = $coupon_value;
                            $outputs = array(
                                'response'=>'coupon applied success',
                                'sub_total'=>$total_price,
                                'grand_total'=> str_replace(',', '', number_format($discount,3)),
                                'coupon_discount'=>$coupon_value,
                                'coupon_code'=>$coupo_arr->coupon_name
                            );
                            echo json_encode($outputs);
                            die();
                        }else{
                            $res = 'Coupon not applicable';   
                        }
                    }else{
                        $discpercent = ($coupon_value / 100) * ($total_price);
                        if($total_price > $discpercent){
                            $discount = $total_price-$discpercent;
                            $coupon_price = $discpercent;
                            $outputs = array(
                                'response'=>'coupon applied success',
                                'sub_total'=>$total_price,
                                'grand_total'=>str_replace(',', '', number_format($discount,2)),
                                'coupon_discount'=>str_replace(',', '', number_format($coupon_price,2)),
                                'coupon_code'=>$coupo_arr->coupon_name
                            );
                            echo json_encode($outputs);
                            die();
                        }else{
                            $res = 'Coupon not applicable';        
                        }
                        
                    }
                }
            }else{
                $res = 'Invalid coupon code';
            }
        }else{
            $res = 'Invalid coupon code';    
        }
        
        $outputs = array(
           'response'=>$res
        );
        echo json_encode($outputs);
        die();
    }
    
    function remove_coupon_code()
    {
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $user_type = $user_sess['type'];
        $where = array('user_id'=>$user_id,'user_type'=>$user_type);
        $cart_total = $this->objcom->get_cart_products($user_id,$user_type);
        //$delivery = $this->common->get_single_record('delivery_charges',array('id'=>1));
        $arrayTotal = array();
        foreach($cart_total as $key=>$row)
        {
            if($row->sale!=0.00){
                $arrayTotal[] = $row->sale*$row->cart_quantity; 
            }else{
                $arrayTotal[] = $row->mrp*$row->cart_quantity; 
            }    
        }
        $cardTotalData = number_format(array_sum($arrayTotal), 2);
        $cleantotal = str_replace(',', '', $cardTotalData);
        $outputs = array(
           'response'=>'coupon removed success',
           'sub_total'=>$cleantotal,
           'grand_total'=>str_replace(',', '', number_format($cleantotal,2)),
           'coupon_discount'=>'00.00',
           'coupon_code'=>''
        );
        echo json_encode($outputs);
        die();
    }
    
    function create_guest_checkout()
    {
        $resmsg = '';
        $user_sess = $this->session->userdata('user_session'); 
        $inputs = $this->input->post();
        $session_id = $user_sess['user_id']; 
        $session_type = $user_sess['type']; 
        $email = $inputs['email'];
        $user_data = $this->common->get_single_record('customers',array('email'=>$email));
        if(empty($user_data))
        {
            $post_arr['first_name'] = $inputs['first_name'];
            $post_arr['last_name'] = $inputs['last_name'];   
            $post_arr['customer_name'] = $inputs['first_name']." ".$inputs['last_name'];
            $post_arr['mobile_number'] = $inputs['mobile'];
            $post_arr['password'] = md5($inputs['password']);
            $post_arr['email'] = $inputs['email'];
            $post_arr['area'] = $inputs['area'];
            $post_arr['block'] = $inputs['block'];
            $post_arr['street'] = $inputs['street'];
            $post_arr['building'] = $inputs['building'];
            $post_arr['avenue'] = $inputs['avenue'];
            $post_arr['floor'] = $inputs['floor'];
            $post_arr['apartment'] = $inputs['apartment'];
            $post_arr['status'] = 1;
            $user_id = $this->common->add_new_customer($post_arr);
            if(!empty($user_id))
            {
                $update_crt['user_id'] = $user_id;
                $update_crt['user_type'] = 'user';
                $wherecrt = array('user_id'=>$session_id,'user_type'=>$session_type);
                if($this->common->update_records('user_cart',$update_crt,$wherecrt))
                {
                    $session_data = array('user_id' => $user_id, 'type' => 'user');
                    $this->session->set_userdata('user_session', $session_data);
                    
                    $addrs_arr['first_name'] = $inputs['first_name'];
                    $addrs_arr['last_name'] = $inputs['last_name'];
                    $addrs_arr['address_name'] = 'Home';
                    $addrs_arr['mobile'] = $inputs['mobile'];
                    $addrs_arr['email'] = $inputs['email'];
                    $addrs_arr['area'] = $inputs['area'];
                    $addrs_arr['block'] = $inputs['block'];
                    $addrs_arr['street'] = $inputs['street'];
                    $addrs_arr['building'] = $inputs['building'];
                    $addrs_arr['avenue'] = $inputs['avenue'];
                    $addrs_arr['floor'] = $inputs['floor'];
                    $addrs_arr['apartment'] = $inputs['apartment'];
                    $addrs_arr['saved_address'] = '';
                    $addrs_arr['address_id'] = '';
                    $this->session->set_userdata('user_address', $addrs_arr);
                    $resmsg = 'checkout success';
                }
            }
        }else{
            $resmsg = 'email address already registered.!';   
        }
        $outputs = array(
           'response'=>$resmsg
        );
        echo json_encode($outputs);
        die();
    }
    
    function checkout_proceed_user()
    {
        if($this->input->post('saved_address')!="")
        {
            $address_sess = $this->input->post();
            $this->session->set_userdata('user_address', $address_sess);
            $outputs = array(
                'response'=>'checkout success',
                'address_session'=>$this->session->userdata('user_address')
            );  
        }else{
            $address_sess = $this->input->post();
            
            if($address_sess['address_save_or']=='save')
            {
                $user_sess = $this->session->userdata('user_session'); 
                $user_id = $user_sess['user_id'];
                $post_arr['addressfname'] = $address_sess['first_name'];
                $post_arr['addresslname'] = $address_sess['last_name'];   
                $post_arr['mobile_number'] = $address_sess['mobile'];
                $post_arr['addressemail'] = $address_sess['email'];
                $post_arr['area'] = $address_sess['area'];
                $post_arr['block'] = $address_sess['block'];
                $post_arr['street'] = $address_sess['street'];
                $post_arr['building'] = $address_sess['building'];
                $post_arr['avenue'] = $address_sess['avenue'];
                $post_arr['floor'] = $address_sess['floor'];
                $post_arr['apartment'] = $address_sess['apartment'];
                $this->common->update_records('customers',$post_arr,array('id'=>$user_id));
                
            }
            
            $this->session->set_userdata('user_address', $address_sess);
            $outputs = array(
                'response'=>'checkout success',
                'address_session'=>$this->session->userdata('user_address')
            );   
        }
        
        echo json_encode($outputs);
        die();
    }
    
    function user_login_auth()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user_arr = $this->common->get_single_record('customers',array('email'=>$email));
        if(!empty($user_arr))
        {
            if($user_arr->password==md5($password)) 
            {
                if($user_arr->status==1)
                {
                    $usercart_arr = $this->objcom->get_single_record('user_cart',array('user_id'=>$user_arr->id,'user_type'=>'user'));
                    if(!empty($usercart_arr)){
                        $user_sess = $this->session->userdata('user_session'); 
                        $user_id = $user_sess['user_id']; 
                        $user_type = $user_sess['type'];
                        $cart_arr = $this->objcom->get_all_where('user_cart',array('user_id'=>$user_id,'user_type'=>$user_type),'');
                        if(!empty($cart_arr)){
                            foreach($cart_arr as $row){
                                $check_cart = check_product_incart($user_arr->id,'user',$row->product_id,$row->variation_id,$row->sizes);
                                if($check_cart==0){
                                    $data_post['user_id'] = $user_arr->id;
                                    $data_post['user_type'] = 'user';
                                    $this->objcom->update_records('user_cart',$data_post,array('id'=>$row->id));
                                }
                            }
                        }
                        $session_data = array('user_id' =>$user_arr->id,'type' => 'user');
                        $this->session->set_userdata('user_session', $session_data);
                        $outputs = array(
                        'response'=>'login successfull'
                        );
                    }else{
                        $user_sess = $this->session->userdata('user_session'); 
                        $user_id = $user_sess['user_id']; 
                        $user_type = $user_sess['type'];
                        $cart_arr = $this->objcom->get_single_record('user_cart',array('user_id'=>$user_id,'user_type'=>$user_type));
                        if(!empty($cart_arr)){
                            $data_post['user_id'] = $user_arr->id;
                            $data_post['user_type'] = 'user';
                            $this->objcom->update_records('user_cart',$data_post,array('user_id'=>$user_id,'user_type'=>$user_type));
                        }
                        $session_data = array('user_id' =>$user_arr->id,'type' => 'user');
                        $this->session->set_userdata('user_session', $session_data);
                        $outputs = array(
                        'response'=>'login successfull'
                        );
                    }
                }else{
                    $outputs = array(
                    'response'=>'account is diactivated.*'
                    );    
                }
            }else{
                $outputs = array(
                'response'=>'Enter correct password.*'
                );    
            }
        }else{
            $outputs = array(
            'response'=>'Email not registered.*'
            );    
        }
        echo json_encode($outputs);
        die();
    }
    
    function user_registration_auth()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $user_arr = $this->objcom->get_single_record('customers',array('email'=>$email));  
        if(empty($user_arr))
        {
            $post_arr['first_name'] = $fname;
            $post_arr['last_name'] = $lname;
            $post_arr['customer_name'] = $fname." ".$lname;
            $post_arr['email'] = $email;
            $post_arr['password'] = md5($password);
            $post_arr['status'] = 1;
            $return_id = $this->objcom->add_new_customer($post_arr);
            if(!empty($return_id))
            {
                $user_sess = $this->session->userdata('user_session'); 
                $user_id = $user_sess['user_id']; 
                $user_type = $user_sess['type'];
                $cart_arr = $this->objcom->get_single_record('user_cart',array('user_id'=>$user_id,'user_type'=>$user_type));
                if(!empty($cart_arr)){
                    $data_post['user_id'] = $return_id;
                    $data_post['user_type'] = 'user';
                    $this->objcom->update_records('user_cart',$data_post,array('user_id'=>$user_id,'user_type'=>$user_type));
                }
                $session_data = array('user_id' =>$return_id,'type' => 'user');
                $this->session->set_userdata('user_session', $session_data);
                $outputs = array(
                'response'=>'registration successfull'
                );    
            }
        }else{
            $outputs = array(
            'response'=>'Email already registered.*'
            );    
        }
        echo json_encode($outputs);
        die();
    }
    
    function update_arch_to_cart()
    {
        $cart_id = $this->input->post('cart_id');
        $arch = $this->input->post('arch'); 
        $update_crt['arch'] = $arch;
        $wherecrt = array('id'=>$cart_id);
        if($this->common->update_records('user_cart',$update_crt,$wherecrt))
        {
            $outputs = array(
            'response'=>'updated'
            );  
            echo json_encode($outputs);
            die();
        }
    }
    
    function apply_coupon_events()
    {
        $user_sess = $this->session->userdata('user_session');
        $user_id = $user_sess['user_id'];
        $res = '';
        $code = $this->input->post('coupon_code');
        $finalprice = 0;
        $booktempdata = $this->common->get_all_where('events_registrations_temp',array('user_id'=>$user_id),'');
        
        if(!empty($booktempdata))
        {
            foreach($booktempdata as $key=>$row){
                
                $finalprice +=$row->amount;
            }
        }
        
        $where = array('coupon_name'=>$code);
        $coupo_arr = $this->common->get_single_record('coupons_table',$where);
        if(!empty($coupo_arr))
        {
            $total_price = $finalprice;
            
            if($coupo_arr->status!=0)
            {
                $today = date('d-m-Y');
                $coupon_exp_date = $coupo_arr->coupon_expiry;
                if($today > $coupon_exp_date)
                {
                    $res = 'Coupon code expired.!';    
                }else{
                    $coupon_type = $coupo_arr->coupon_type;
                    $coupon_value = $coupo_arr->coupon_value;
                    if($coupon_type=='Flat')
                    {
                        if($total_price>$coupon_value)
                        {
                            $discount = number_format($total_price-$coupon_value,2); 
                            $coupon_price = $coupon_value;
                            $outputs = array(
                               'response'=>'coupon applied success',
                               'sub_total'=>number_format($finalprice,2),
                               'grand_total'=>$discount,
                               'coupon_discount'=>$coupon_price,
                               'coupon_code'=>$coupo_arr->coupon_name
                            );
                            echo json_encode($outputs);
                            die();
                        }else{
                            $outputs = array(
                               'response'=>'coupon not applicable.!'
                            );
                            echo json_encode($outputs);
                            die();    
                        }
                    }else{
                        $discpercent = ($coupon_value / 100) * ($total_price);
                        if($total_price>$discpercent)
                        {
                            $discount = $total_price-$discpercent;
                            $coupon_price = $discpercent;
                            $outputs = array(
                               'response'=>'coupon applied success',
                               'sub_total'=>$dist_arr->price,
                               'grand_total'=>$discount,
                               'coupon_discount'=>$coupon_price,
                               'coupon_code'=>$coupo_arr->coupon_name
                            );
                            echo json_encode($outputs);
                            die();
                        }else{
                            $outputs = array(
                               'response'=>'coupon not applicable.!'
                            );
                            echo json_encode($outputs);
                            die();    
                        }
                    }
                }
            }else{
                $res = 'Invalid coupon code.!';
            }
        }else{
            $res = 'Invalid coupon code.!';    
        }
        
        $outputs = array(
           'response'=>$res
        );
        echo json_encode($outputs);
        die();
    }
    
    // function event_registration()
    // {
    //     $user_sess = $this->session->userdata('user_session'); 
    //     $user_id = $user_sess['user_id'];
    //     $user_type = $user_sess['type'];
        
    //     date_default_timezone_set('Asia/Kuwait');
    //     $inputs = $this->input->post();
    //     $email = $inputs['athlete_email'];
    //     $event_id = $inputs['event_id'];
    //     $distance = $inputs['distance'];
        
    //     $data_arr = $this->common->get_single_record('events_registrations',array('event_id'=>$event_id,'event_distance'=>$distance,'athlete_email'=>$email));
    //     $distance_arr = $this->common->get_single_record('events_details',array('id'=>$distance));
        
    //     if(empty($data_arr))
    //     {
    //         if($user_type=='user')
    //         {
    //             $post_arr['user_id'] = $user_id; 
    //         }
    //         $post_arr['event_id'] = $inputs['event_id'];
    //         $post_arr['event_distance'] = $inputs['distance'];
    //         $post_arr['athlete_fname'] = $inputs['fname'];
    //         $post_arr['athlete_lname'] = $inputs['lname'];
    //         $post_arr['athlete_residency'] = $inputs['country'];
    //         $post_arr['athlete_dob'] = $inputs['athlete_dob'];
    //         $post_arr['athlete_email'] = $inputs['athlete_email'];
    //         $post_arr['athlete_mobile'] = $inputs['athlete_mobile'];
    //         $post_arr['athlete_tshirtsize'] = $inputs['t_shirt'];
    //         $post_arr['mobile_code'] = $inputs['mobile_code'];
    //         $post_arr['amount'] = $inputs['total_amt'];
    //         $post_arr['coupon_name'] = $inputs['coupon'];
    //         $post_arr['coupon_value'] = $inputs['coupon_val'];
    //         $post_arr['registration_date'] = date('Y-m-d H:i:s');
            
    //         $post_arr['randomid'] = $inputs['uniqueid'];
            
    //         // $reg_id = $this->common->insert_and_return_id('events_registrations',$post_arr);
    //         $reg_id = $this->common->insert_and_return_id('events_registrations_temp',$post_arr);
    //         if($reg_id!="")
    //         {
    //             // check booking count
    //             $available = 0;
    //             $countdata = $this->common->get_all_where('events_registrations_temp',array('randomid'=>$inputs['uniqueid']),'');
    //             $entry     = count($countdata);
    //             $available = $book_count-$entry;
    //             //

    //             $remtick = $distance_arr->remain_tickets;
    //             $post_upd['remain_tickets'] = ($remtick-$book_count);
    //             $this->common->update_records('events_details',$post_upd,array('id'=>$distance));
                
    //             // final price collect by loop
    //             $finalprice = 0;
                
    //             $outputs = array(
    //               'response'=>'registered success',
    //               'reg_id'=>$reg_id,
    //               'uniqueid'=>$inputs['uniqueid'],
    //               'available'=>$available,
    //               'finalprice'=>$finalprice
    //             );
    //             echo json_encode($outputs);
    //             die();         

                
    //             // $remtick = $distance_arr->remain_tickets;
    //             // $post_upd['remain_tickets'] = ($remtick-1);
    //             // if($this->common->update_records('events_details',$post_upd,array('id'=>$distance)))
    //             // {
    //             //     $outputs = array(
    //             //       'response'=>'registered success',
    //             //       'reg_id'=>$reg_id,
    //             //       'available'=>$available
    //             //     );
    //             //     echo json_encode($outputs);
    //             //     die();         
    //             // }
                
    //         }
    //     }else{
    //         $outputs = array(
    //           'response'=>'already registered',
    //           'reg_id'=>''
    //         );
    //         echo json_encode($outputs);
    //         die();      
    //     }
         
    // }
    
    function get_distance_data()
    {
        $id = $this->input->post('dist_id');
        $data_arr = $this->common->get_single_record('events_details',array('id'=>$id));
        if($data_arr->remain_tickets>0)
        {
            $res = 1;
        }else{
            $res = 0;
        }
        $outputs = array(
           'response'=>$res,
           'total_tickets'=>$data_arr->remain_tickets
        );
        echo json_encode($outputs);
        die();    
    }
    
    function subscribe_process()
    {
        date_default_timezone_set('Asia/Kuwait');
        $date_time = date('Y-m-d H:i:s');
        $email = $this->input->post('email');
        $res = '';
        $bol = '';
        $data_arr = $this->common->get_single_record('subscribers',array('email'=>$email));
        if(empty($data_arr))
        {
            $data['email']=$email;
            $data['date']=$date_time;
            if($this->common->insert_data('subscribers',$data))
            {
                $bol = true;
                $res = $this->lang->line('thanksSubscribed');    
            }
        }else{
            $bol = false;
            $res = $this->lang->line('alreadySubscribed');    
        }
        $outputs = array(
           'response'=>$res,
           'code'=>$bol
        );
        echo json_encode($outputs);
        die();
    }
    
    function send_enquiries()
    {
        date_default_timezone_set('Asia/Kuwait');
        $date_time = date('Y-m-d H:i:s');
        $input = $this->input->post();
        $res = '';
        $bol = '';
        $post['email'] = $input['email'];
        $post['message'] = $input['message'];
        $post['date'] = $date_time;
        if($this->common->insert_data('contact_us',$post))
        {
            $bol = true;
            $res = 'Thank you.! Your message has been successfully sent.';    
        }else{
            $bol = false;
            $res = 'Something went wrong.!';    
        }
        $outputs = array(
           'response'=>$res,
           'code'=>$bol
        );
        echo json_encode($outputs);
        die();
    }
    
    function get_blogs_comments()
    {
        $blog_id = $this->input->post('blog_id');
        $comments = $this->common->get_all_where('blogs_comments',array('blog_id'=>$blog_id),'');
        $output = '';
        if(!empty($comments))
        {
            foreach($comments as $row)
            {
                $output .= '<div class="blog-21">';  
    			$output .= '<h3>'.$row->name.'</h3>';  
    			$output .= '<p>'.$row->comment.'</p>';  
    			$output .= '<div class="div-border"></div>';  
        		$output .= '</div>'; 
            }
        }
        $outputs = array(
           'total_comments'=>count($comments),
           'comments'=>$output
        );
        echo json_encode($outputs);
        die();
    }
    
    function submit_blog_comment()
    {
        $res = '';
        date_default_timezone_set('Asia/Kuwait');
        $inputs = $this->input->post();    
        $post_arr['email'] = $inputs['email'];
        $post_arr['comment'] = $inputs['comment'];
        $post_arr['name'] = $inputs['name'];
        $post_arr['blog_id'] = $inputs['blog_id'];
        $post_arr['date_time'] = date('Y-m-d H:i:s');
        if($this->common->insert_data('blogs_comments',$post_arr))
        {
            $res = 'comment submit';    
        }else{
            $res = 'Something went wrong.!';    
        }
        $outputs = array(
           'response'=>$res
        );
        echo json_encode($outputs);
        die();
    }
    
    function update_customers_data()
    {
        $inputs = $this->input->post();
        /*$outputs = array(
               'response'=>$inputs
        );
        echo json_encode($outputs);
        die();*/
        $post['customer_name'] = $inputs['user_name'];
        $post['mobile_number'] = $inputs['user_mobile'];
        $post['country_id'] = $inputs['country'];
        $post['gender'] = $inputs['gender'];
        $post['dob'] = $inputs['dob'];
        $post['medical_condition'] = $inputs['medical_cond'];
        $post['relative_name'] = $inputs['rel_name'];
        $post['relative_relation'] = $inputs['rel_relation'];
        $post['relative_mobile'] = $inputs['rel_number'];
        $post['t_shirt'] = $inputs['t_shirt'];
        $post['news_letter'] = $inputs['news_letter'];
        $post['policy'] = $inputs['policy'];
        $email = $inputs['email'];
        if($inputs['news_letter']==1)
        {
            $data_arr = $this->common->get_single_record('subscribers',array('email'=>$email)); 
            if(!empty($data_arr))
            {
                $post_arr['email'] = $inputs['email'];
                $post_arr['date'] = date('Y-m-d H:i:s');
                $this->common->insert_data('subscribers',$post_arr);    
            }
        }
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $name = $this->input->post('user_name');
        if($this->common->update_records('customers',$post,array('id'=>$user_id)))
        {
            $outputs = array(
               'response'=>'updated'
            );
            echo json_encode($outputs);
            die();         
        }else{
            $outputs = array(
           'response'=>'something went wrong.!'
            );
            echo json_encode($outputs);
            die();    
        } 
        
        
    }
    
    function update_customer_new_paasword()
    {
        $inputs = $this->input->post();
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $data_arr = $this->common->get_single_record('customers',array('id'=>$user_id));
        if($data_arr->password==md5($inputs['current_password']))
        {
            $post['password'] = md5($inputs['new_password']);   
            if($this->common->update_records('customers',$post,array('id'=>$user_id)))
            {
                $outputs = array(
                   'response'=>'password changed'
                );
                echo json_encode($outputs);
                die();         
            }
        }else{
            $outputs = array(
               'response'=>'current password issue'
            );
            echo json_encode($outputs);
            die();     
        }
        
    }
    
    function reset_customer_new_paasword()
    {
        $inputs = $this->input->post();
        $user_id = $inputs['user_id'];
        //echo"<pre>";print_r($inputs);die;
        $post_array['password'] = md5($inputs['new_password']);  
        $post_array['forget_pass_req'] = 0;
        if($this->objcom->update_records('customers',$post_array,array('id'=>$user_id)))
        {
            $outputs = array(
               'response'=>'password changed'
            );
            echo json_encode($outputs);
            die();         
        }else{
             $outputs = array(
               'response'=>'something went wrong'
            );
            echo json_encode($outputs);
            die();
        }
        
    }
    
    function get_event_gallery()
    {
        $event_id = $this->input->post('event_id');
        $date = date('Y-m-d', strtotime($this->input->post('date_gal')));
        $gallery_array = $this->common->event_details_gallery_filter($event_id,$date);
        $output = '';
        if(!empty($gallery_array))
        {
            foreach($gallery_array as $row)
            {
        		$output .= '<div class="col-6 col-sm-3 col-md-3 gallery-cols">';
			    $output .= '<div class="img-wraper">';
			    $output .= '<a><img src="'.base_url("uploads/events-gallery/").$row->file_name.'">';
			    $output .= '<div class="overlay"></div>';
			    $output .= '</a>';
			    $output .= '</div>';
				$output .= '</div>';
            }
        }
        
        $outputs = array(
           'total_image'=>count($gallery_array),
           'response'=>$output
        );
        echo json_encode($outputs);
        die();
    }
    
    
    
    function event_registration_new()
    {
        $user_sess = $this->session->userdata('user_session'); 
        $user_id   = $user_sess['user_id'];
        $user_type = $user_sess['type'];
        
        date_default_timezone_set('Asia/Kuwait');
        
        $inputs   = $this->input->post();
        $email    = $inputs['athlete_email'];
        $event_id = $inputs['event_id'];
        $distance = $inputs['distance'];

        // add validation for eventid, distance with email
        // if($user_id=='')
        // {
        //     $outputs = array(
        //       'response'=>'You must be login before registered on this event',
        //       'reg_id'=>''
        //     );
        //     echo json_encode($outputs);
        //     die();            
        // }
        
        
        // add validation for eventid, distance with email
        $data_arr1 = $this->common->get_single_record('events_registrations',array('event_id'=>$event_id,'event_distance'=>$distance,'athlete_email'=>$email));
        if(!empty($data_arr1))
        {
            $outputs = array(
               'response'=>'already registered with this email',
               'reg_id'=>''
            );
            echo json_encode($outputs);
            die();            
        }
        
        // add validation for eventid, distance with email
        $data_arr2 = $this->common->get_single_record('events_registrations_temp',array('event_id'=>$event_id,'event_distance'=>$distance,'athlete_email'=>$email));
        if(!empty($data_arr2))
        {
            $outputs = array(
               'response'=>'already registered with this email',
               'reg_id'=>''
            );
            echo json_encode($outputs);
            die();            
        }
        
        // check for available or not
        // $distance_arr = $this->common->get_single_record('events_details',array('id'=>$distance));
        // if($distance_arr->remain_tickets>0){
            
        // }else{
        //     $outputs = array(
        //       'response'=>'not available booking',
        //       'reg_id'=>''
        //     );
        //     echo json_encode($outputs);
        //     die();            
        // }
        
        $total_remains = 0;
        $mainbook = 0;
        $tempbook = 0;
        
        $distance_arr = $this->common->get_single_record('events_details',array('id'=>$distance));
        $mainbook = $distance_arr->remain_tickets;

        $booktempdata_dist = $this->common->get_all_where('events_registrations_temp',array('event_id'=>$event_id,'event_distance'=>$distance),'');
        if(!empty($booktempdata_dist))
        {
            $tempbook = count($booktempdata_dist);
        }
        $total_remains = $mainbook-$tempbook;
        
        
        if($total_remains>0){
            
        }else{
            $outputs = array(
               'response'=>'not available booking',
               'reg_id'=>''
            );
            echo json_encode($outputs);
            die();            
        }

        
        if($user_type=='user')
        {
            $post_arr['user_id'] = $user_id; 
        }
        
        $post_arr['event_id']           = $inputs['event_id'];
        $post_arr['event_distance']     = $inputs['distance'];
        $post_arr['athlete_fname']      = $inputs['fname'];
        $post_arr['athlete_lname']      = $inputs['lname'];
        $post_arr['athlete_residency']  = $inputs['country'];
        $post_arr['athlete_dob']        = $inputs['athlete_dob'];
        $post_arr['athlete_email']      = $inputs['athlete_email'];
        $post_arr['athlete_mobile']     = $inputs['athlete_mobile'];
        $post_arr['athlete_tshirtsize'] = $inputs['t_shirt'];
        
        $post_arr['ath_gender'] = $inputs['gender'];
        $post_arr['medical_condition'] = $inputs['medical_cond'];
        $post_arr['rel_name'] = $inputs['rel_name'];
        $post_arr['rel_relation'] = $inputs['rel_relation'];
        $post_arr['rel_mobile'] = $inputs['rel_number'];
        
        $post_arr['mobile_code']        = $inputs['mobile_code'];
        
        $post_arr['amount']       = $distance_arr->price;
        
        $post_arr['coupon_name']  = '';
        $post_arr['coupon_value'] = '';            
        $post_arr['registration_date'] = date('Y-m-d H:i:s');
        //$post_arr['randomid'] = $inputs['uniqueid'];
        
        $reg_id = $this->common->insert_and_return_id('events_registrations_temp',$post_arr);
        if($reg_id!="")
        {
            
            $tempbookdata_html ='';
	    
    	    $tempbookdata = $this->common->get_all_where('events_registrations_temp',array('user_id'=>$user_id,'event_id'=>$event_id),'');
    	    $data['tempbookdata'] = $tempbookdata;
            $tempbookdata_html =  $this->load->view('FRONT/events/event_registration_ajax',array('data'=>$data),true); 

            $available = ($total_remains-1);
            
            // final price collect by loop
            $finalprice = 0;
            $booktempdata = $this->common->get_all_where('events_registrations_temp',array('user_id'=>$user_id),'');
            
            if(!empty($booktempdata))
            {
                foreach($booktempdata as $key=>$row){
                    
                    $finalprice +=$row->amount;
                }
            }       
            $finalprice =number_format($finalprice,2);
            
            $outputs = array(
               'response'=>'registered success',
               'reg_id'=>$reg_id,
               'user_id'=>$user_id,
               'available'=>$available,
               'finalprice'=>$finalprice,
               'tempbookdata_html'=>$tempbookdata_html
            );
            
            echo json_encode($outputs);
            die();
            
        }else{
            
            $outputs = array(
               'response'=>'registered not success',
               'reg_id'=>$post_arr
            );
            
            echo json_encode($outputs);
            die();            
        }
        
            
    }
    
    
    
    function event_registration()
    {
        // copy temp to main register for that user
        $user_sess = $this->session->userdata('user_session'); 
        $user_id = $user_sess['user_id'];
        $user_type = $user_sess['type'];
        
        date_default_timezone_set('Asia/Kuwait');
        
        $inputs = $this->input->post();

        $booktempdata = $this->common->get_all_where('events_registrations_temp',array('user_id'=>$user_id),'');

        foreach($booktempdata as $key=>$row)
        {
            $data = array(
                    'user_id'=>$row->user_id,
                    'event_id'=>$row->event_id,
                    'event_distance'=>$row->event_distance,
                    'athlete_fname'=>$row->athlete_fname,
                    'athlete_lname'=>$row->athlete_lname,
                    'athlete_residency'=>$row->athlete_residency,
                    'athlete_dob'=>$row->athlete_dob,
                    'athlete_email'=>$row->athlete_email,
                    'mobile_code'=>$row->mobile_code,
                    'athlete_mobile'=>$row->athlete_mobile,
                    'athlete_tshirtsize'=>$row->athlete_tshirtsize,
                    'ath_gender'=>$row->ath_gender,
                    'medical_condition'=>$row->medical_condition,
                    'rel_name'=>$row->rel_name,
                    'rel_relation'=>$row->rel_relation,
                    'rel_mobile'=>$row->rel_mobile,
                    'amount'=>$row->amount,
                    'coupon_name'=>$row->coupon_name,
                    'coupon_value'=>$row->coupon_value,
                    'registration_date'=>$row->registration_date
                    );
            
            $this->common->insert_data('events_registrations',$data);
            
            // $distance_arr = $this->common->get_single_record('events_details',array('id'=>$row->event_distance));
            // $remtick = $distance_arr->remain_tickets;
            // $post_upd['remain_tickets'] = ($remtick-1);
            // $this->common->update_records('events_details',$post_upd,array('id'=>$row->event_distance));
            
            
            $wheredata = array('registration_id'=>$row->registration_id);
            $this->common->delete_record('events_registrations_temp',$wheredata);
        }    

        $outputs = array(
          'inputs'=>$inputs
        );        
        echo json_encode($outputs);
        die();        
        
    } 
    
    function process_forget_password()
    {
        $res = '';
        $email = $this->input->post('email');
        $user_arr = $this->objcom->get_single_record('customers',array('email'=>$email));
        if(!empty($user_arr))
        {
            $data['user_id'] = $user_arr->id;
	        $email_data = $this->load->view('Emails/user-forget-password',$data,TRUE); 
	        
	        $this->load->library('email');
	        $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.gmail.com';
            $config['smtp_port'] = '465'; // Use 465 for SSL, or 587 for TLS
            $config['smtp_crypto'] = 'ssl'; // Use 'ssl' or 'tls' based on the port
            $config['smtp_user'] = 'shankarkr35@gmail.com';
            $config['smtp_pass'] = 'rnlfgrmdhzltvlyy';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            
            $this->email->from("shankarkr35@gmail.com","G2A");
            $this->email->to('shankar.wxit@gmail.com');
            $this->email->subject('Reset your password');
            $this->email->message($email_data);
            
            if($this->email->send())
            {
                $post_upd['forget_pass_req'] = 1;
                if($this->objcom->update_records('customers',$post_upd,array('id'=>$user_arr->id)))
                {
                    $res = "success";    
                }
            }
            
        }else{
            $res = "user not found!";    
        }
        $outputs = array(
          'response'=>$res
        );        
        echo json_encode($outputs);
        die();     
    }
    
    

 
    function removetempdatabyid()
    {
        $user_sess = $this->session->userdata('user_session'); 
        $user_id   = $user_sess['user_id'];
        $user_type = $user_sess['type'];
        
        date_default_timezone_set('Asia/Kuwait');
        
        $inputs   = $this->input->post();
        
        $registration_id = $inputs['registration_id'];

        $distance_arr = $this->common->get_single_record('events_registrations_temp',array('registration_id'=>$registration_id));
        $event_id = $distance_arr->event_id;
        
        $this->common->delete_record('events_registrations_temp',array('registration_id'=>$registration_id));
        
        $tempbookdata_html ='';

	    $tempbookdata = $this->common->get_all_where('events_registrations_temp',array('user_id'=>$user_id,'event_id'=>$event_id),'');
	    $data['tempbookdata'] = $tempbookdata;
        
        $tempbookdata_html =  $this->load->view('FRONT/events/event_registration_ajax',array('data'=>$data),true);
        
        $subtotal = 0;

        foreach($tempbookdata as $key1=>$row1)
        {
            $subtotal+=$row1->amount;
        }
                
        $subtotal1 = number_format($subtotal,2);

        $outputs = array(
           'response'=>'remove success',
           'tempbookdata_html'=>$tempbookdata_html,
           'subtotal'=>$subtotal1
        );
        
        echo json_encode($outputs);
        die();

    } 
    
    function load_categories_grid()
    {
        $data_array['categories'] = $this->objcom->select_categories('categories','id,name,ar_name',array('status'=>1),'sort_order');
        $data_html =  $this->load->view('FRONT/ajax/categories-grid',$data_array,TRUE);
        $outputs = array(
            'response'=>$data_html
        );
        echo json_encode($outputs);
        die(); 
    }
    function load_categories_grid_mobile()
    {
        $data_array['categories'] = $this->objcom->select_categories('categories','id,name,ar_name',array('status'=>1),'sort_order');
        $data_html =  $this->load->view('FRONT/ajax/categories-grid-mobile',$data_array,TRUE);
        $outputs = array(
            'response'=>$data_html
        );
        echo json_encode($outputs);
        die(); 
    }
    function update_profile()
    {
        $inputs = $this->input->post();
        $user_sess = $this->session->userdata('user_session'); 
	    $user_id = $user_sess['user_id'];
        if($this->objcom->update_records('customers',$inputs,array('id'=>$user_id))){
            $res = 'updated';
        }else{
            $res = 'something wrong';   
        }
        $outputs = array(
            'response'=>$res
        );
        echo json_encode($outputs);
        die();   
    }
    
    function submitProductRatings()
    {
        $inputs = $this->input->post();  
        $post_arr['product_id'] = $inputs['product'];
        $post_arr['ratings'] = $inputs['rate'];
        $post_arr['name'] = $inputs['name'];
        $post_arr['email'] = $inputs['email'];
        $Check_arr = $this->objcom->get_single_record('products_ratings',array('email'=>$inputs['email'],'product_id'=>$inputs['product']));
        if(empty($Check_arr)){
            if($this->objcom->insert_data('products_ratings',$post_arr))
            {
                $res = 'success';    
            }else{
                $res = 'something wrong';   
            }   
        }else{
            if($this->objcom->update_records('products_ratings',$post_arr,array('id'=>$Check_arr->id))){
                $res = 'success';
            }else{
                $res = 'something wrong';   
            }    
        }
        
        $outputs = array(
            'response'=>$res
        );
        echo json_encode($outputs);
        die(); 
    }
    
    function ProductRatings()
    {
        $inputs = $this->input->post();  
        $records = $this->objcom->get_all_where('products_ratings',array('product_id'=>$inputs['product']),'id');
        $record = $this->objcom->get_ratings($inputs['product']);
        if(!empty($records)){
            $ratings = $record->ratings;
        }else{
            $ratings = 0;    
        }
        $outputs = array(
            'ratings'=>$ratings,
            'reviews'=>count($records)
        );
        echo json_encode($outputs);
        die(); 
    }
   
    

/*Main Class Ending*/	
}
