<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    function insert_data($tbl,$data)
    {

        if($this->db->insert($tbl,$data))
        {
            return TRUE;
        }

    }

    function insert_batch_data($tbl,$data)

    {

        if($this->db->insert_batch($tbl, $data))

        {

            return TRUE;

        }

    }

    

    function insert_and_return_id($tbl,$data)

    {

        $this->db->insert($tbl, $data);

        return $this->db->insert_id();

    }

    

    function add_new_customer($data)

    {

        $this->db->insert('customers', $data);

        return $this->db->insert_id();

    }

    

    function get_single_record($table,$where)
    {
        $query = $this->db->get_where($table,$where);
        return $query->row();
    }
    function get_single_data($table,$where,$id)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where('id !=', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function select_where_in_array($table,$col,$where,$oderBy)
    {

        $this->db->select('*');
        $this->db->from($table);
        if (!empty($where)) 
        {
            $this->db->where_in($col,$where);
        }
        if (!empty($oderBy)) 
        {
            $this->db->order_by($oderBy, 'DESC');
        }
        $query = $this->db->get(); 
        return $query->result();

    }

    function get_all_where($table,$where,$oderBy)
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($where)) 
        {
            $this->db->where($where);
        }
        if (!empty($oderBy)) 
        {
            $this->db->order_by($oderBy, 'DESC');
        }
        $query = $this->db->get(); 
        return $query->result();

    }
    function get_all_where_limit($table,$where,$oderBy,$limit)
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($where)) 
        {
            $this->db->where($where);
        }
        if (!empty($oderBy)) 
        {
            $this->db->order_by($oderBy, 'DESC');
        }
        if (!empty($limit)) 
        {
            $this->db->limit($limit);
        }
        $query = $this->db->get(); 
        return $query->result();

    }

    

    function update_records($tbl,$data,$where)

    {

        $this->db->where($where);

        if($this->db->update($tbl,$data))

        {

            return TRUE;

        }

    }

    

    function delete_record($tbl,$where)

    {

        if($this->db->delete($tbl,$where))

        {

            return TRUE;

        }

    }

    

    public function updateMedia($image, $folder,$file_prefix, $height = 768, $width = 1024, $path = FALSE)

    {

        $this->makedirs($folder);

        $realpath = $path ? '../uploads/' : 'uploads/';

        $allowed_types = "*";

        $img_name = $this->authToken($file_prefix);

        $img_sizes_arr = $this->image_sizes($folder); 

        //$min_width = $img_sizes_arr['thumbnail']['width'];

        //$min_height = $img_sizes_arr['thumbnail']['height'];

        $config = array('upload_path' => $realpath . $folder, 'allowed_types' => $allowed_types,'file_name' => $img_name, 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'quality' => '100%',);

        $this->load->library('upload');

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($image)) {

            $error = array('error' => $this->upload->display_errors());

            return $error;

        }

        $image_data = $this->upload->data();

        $this->load->library('image_lib');

        $thumb_img = '';

        foreach ($img_sizes_arr as $k => $v) {

            $sub_folder = $folder . $v['folder'];

            $this->makedirs($sub_folder);

            $real_path = realpath(FCPATH . $realpath . $folder);

            $resize['image_library'] = 'gd2';

            $resize['source_image'] = $image_data['full_path'];

            $resize['new_image'] = $real_path . $v['folder'] . '/' . $image_data['file_name'];

            $resize['maintain_ratio'] = TRUE; 

            $resize['width'] = $v['width'];

            $resize['height'] = $v['height'];

            $resize['quality'] = '100%';

            $dim = (intval($image_data["image_width"]) / intval($image_data["image_height"])) - ($v['width'] / $v['height']);

            $resize['master_dim'] = ($dim > 0) ? "height" : "width";

            $this->image_lib->initialize($resize);

            $is_resize = $this->image_lib->resize();

            $source_img = $real_path . $v['folder'] . '/' . $image_data['file_name'];

            if ($is_resize && file_exists($source_img)) {

                $source_image_arr = getimagesize($source_img);

                $source_image_width = $source_image_arr[0];

                $source_image_height = $source_image_arr[1];

                $source_ratio = $source_image_width / $source_image_height;

                $new_ratio = $v['width'] / $v['height'];

                if ($source_ratio != $new_ratio) {

                    $crop_config['image_library'] = 'gd2';

                    $crop_config['source_image'] = $source_img;

                    $crop_config['new_image'] = $source_img;

                    $crop_config['quality'] = "100%";

                    $crop_config['maintain_ratio'] = TRUE;

                    $crop_config['width'] = $v['width'];

                    $crop_config['height'] = $v['height'];

                    if ($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))) {

                        $crop_config['y_axis'] = round(($source_image_width - $crop_config['width']) / 2);

                        $crop_config['x_axis'] = 0;

                    } else {

                        $crop_config['x_axis'] = round(($source_image_height - $crop_config['height']) / 2);

                        $crop_config['y_axis'] = 0;

                    }

                    $this->image_lib->initialize($crop_config);

                    $this->image_lib->crop();

                    $this->image_lib->clear();

                }

            }

        }

        if (empty($thumb_img)) $thumb_img = $image_data['file_name'];

        return $thumb_img;

    }



    public function makedirs($folder = '', $mode = DIR_WRITE_MODE, $defaultFolder = 'uploads/') 

    {

        if (!@is_dir(FCPATH . $defaultFolder)) {

            mkdir(FCPATH . $defaultFolder, $mode);

        }

        if (!empty($folder)) {

            if (!@is_dir(FCPATH . $defaultFolder . '/' . $folder)) {

                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode, true);

            }

        }

    } 



    public function authToken($file_prefix) 

    {

        return $file_prefix.'_'.strtoupper(md5(base64_encode(rand())));

    }



    public function image_sizes($folder) 

    {

        $img_sizes = array();

        switch ($folder) {

            case 'admin':

                $img_sizes['thumbnail'] = array('width' => 50, 'height' => 50, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'categories':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'subcategory':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'banner':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'posts':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'brands':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'fcat':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'gallery':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'Events':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'blogs':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'aboutus':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'members':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'homesliders':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'flags':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'adv':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'homebanners':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'shop':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

        }

        return $img_sizes;

    }

    

    function get_products_list()

    {

        $query = "SELECT `products`.`id` AS product_id,`products`.`name`,`products`.`ar_name`,`products`.`status`, `categories`.`name` as category_name FROM `products` JOIN `categories` ON `categories`.`id` = `products`.`category` ORDER BY `products`.`id` DESC";

        $qry = $this->db->query($query);

        return $qry->result();

    }

    

    function get_products_variation($proid)

    {

        $query = "SELECT `product_variations`.`id`,`product_variations`.`image`,`product_variations`.`sale_price`,`product_variations`.`status`, `colors`.`name` as color_name,`sizes`.`name` as size_name FROM `product_variations` lEFT JOIN `colors` ON `colors`.`id` = `product_variations`.`color` lEFT JOIN `sizes` ON `sizes`.`id` = `product_variations`.`size` WHERE `product_variations`.`product_id` = '$proid'";

        $qry = $this->db->query($query);

        return $qry->result();

    }

    

    function test_query($perpage,$start,$categories,$sizes,$colors,$price)

    {

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $categories $sizes $colors $price

        GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` DESC LIMIT $start $perpage";

        $query = $this->db->query($qry);

        $data = $query->result();

        echo $this->db->last_query();die;

    }

    

    function count_filtered_products($discount_str,$ptype_str,$categories,$scategories,$sizes,$colors,$price,$genders,$uses_pro)

    {
        

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $discount_str $ptype_str $categories $scategories $sizes $colors $genders $uses_pro $price

        GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id`";

        $query = $this->db->query($qry);
        
        return $query->num_rows();
    

    }

    

    function get_filtered_products($perpage,$start,$categories,$scategories,$sizes,$colors,$price,$sort_by,$genders,$uses_pro,$ptype_str,$discount_str)

    {

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $discount_str $ptype_str $categories $scategories $sizes $colors $genders $uses_pro $price

        GROUP BY `product_variations`.`product_id` $sort_by LIMIT $start $perpage";

        $query = $this->db->query($qry);

        $data = $query->result();

        $output = '';

        $lang = $this->session->userdata('site_lang');

        $user_sess = $this->session->userdata('user_session');

        if(!empty($data))

        {

            foreach($data as $key=>$each_pro)

            {   

                

                $incart = check_product_incart($user_sess['user_id'],$user_sess['type'],$each_pro->product_id,$each_pro->variation_id);

                $inwish = check_product_inwish($user_sess['user_id'],$each_pro->product_id,$each_pro->variation_id);

                $output .= '<div class="col-6 col-sm-4 col-md-3">';

                $output .= '<div class="product-default inner-quickview inner-icon">';

                $output .= '<figure>';

                $output .= '<a href="'.base_url().'shop/'.$each_pro->titleUrl.'"><img src="'.base_url().'uploads/products/medium/'.$each_pro->image.'"></a>';

                $output .= '</figure>';
                
                $output .= '<div class="custom-product-details">';

                $output .= '<div class="product-details">';

                $output .= '<h3 class="product-title"><a href="'.base_url().'shop/'.$each_pro->titleUrl.'" title="'.(($lang=="english")?$each_pro->name:$each_pro->ar_name).'">'.(($lang=="english")?text_limit($each_pro->name,5):text_limit($each_pro->ar_name,5)).'</a></h3>';

                $output .= '<div class="price-box">';

                if($each_pro->mrp_price!='0.00')
                {
                    $output .= '<span class="old-price">'.number_format($each_pro->mrp_price,2).' KD</span>';
    
                    $output .= '<span class="product-price">'.number_format($each_pro->sale_price,2).' KD</span>';
                }else{
                    $output .= '<span class="product-price">'.number_format($each_pro->sale_price,2).' KD</span>';    
                }
                
                $output .= '</div>';

                $output .= '</div>';
                

                $output .= '<div class="btn-icon-group">';

                $output .= '<button class="btn-icon btn-add-cart '.(($incart==0)?'add-to-cart-custom':'').'" id="cart-btn'.$each_pro->product_id.$each_pro->variation_id.'" pid="'.$each_pro->product_id.'" varid="'.$each_pro->variation_id.'">'.(($incart==0)?$this->lang->line('Addtocart'):$this->lang->line('Incart')).'</button>';

                if($user_sess['type']=='user')

                {

                $output .= '<a href="javascript:void(0)" class="add-wishlist custom-add-wish '.(($inwish==1)?'in-wishlist':'').'" data-key="shop-wish-" id="shop-wish-'.$each_pro->product_id.$each_pro->variation_id.'" pid="'.$each_pro->product_id.'" varid="'.$each_pro->variation_id.'"></a>';

                }else{

                $output .= '<a href="javascript:void(0)" class="add-wishlist add-wish-logout-custom"></a>';    

                }

                $output .= '</div>';
                
                $output .= '</div>';

                $output .= '</div>';

                $output .= '</div>';    

            }

        }

        return $output;

    }

    

    function count_filtered_events($date_str,$categories,$ages_grp,$price)

    {

        $qry = "SELECT `events`.*, `events_details`.`id` as `eved_id`, `events_details`.* FROM `events` 

        JOIN `events_details` ON `events_details`.`event_id` = `events`.`id` WHERE `events`.`status` = '1' $date_str $categories $ages_grp $price

        GROUP BY `events_details`.`event_id` ORDER BY `events`.`id` DESC";

        $query = $this->db->query($qry);

        return $data = $query->result(); 

    }

    

    function get_filtered_events($perpage,$start,$categories,$ages_grp,$price,$date_str,$sort_str)

    {

        $qry = "SELECT `events`.*, `events_details`.`id` as `eved_id`, `events_details`.* FROM `events` 

        JOIN `events_details` ON `events_details`.`event_id` = `events`.`id` WHERE `events`.`status` = '1' $date_str $categories $ages_grp $price

        GROUP BY `events_details`.`event_id` $sort_str LIMIT $start $perpage";

        $query = $this->db->query($qry);

        $data = $query->result();  

        $output = '';

        $lang = $this->session->userdata('site_lang');

        if(!empty($data))

        {

            foreach($data as $row)

            {

                $event_start_time = date("Y-m-d", strtotime($row->event_date)).' '.date("H:i", strtotime($row->event_start_time)).':00';

                date_default_timezone_set('Asia/Kuwait');

                $current_time = date("Y-m-d H:i:s");

                

                $distances = "";

                $event_id = $row->event_id;

                $qry1 = "SELECT * FROM `events_details` WHERE `event_id` = '$event_id' ORDER BY `id` ASC";

                $que = $this->db->query($qry1);

                $dedata = $que->result();

                foreach($dedata as $key=>$dis)

                {

                    $distances = $distances.$dis->distance." - ";

                }

                $output .= '<div class="col-md-6">';

    			$output .= '<article class="post">';

    			$output .= '<div class="post-media">';

    			$output .= '<a href="'.base_url("event/").$row->event_url.'">';

    			$output .= '<div style="background-image:url('.base_url()."uploads/Events/medium/".$row->banner_img.');background-size: cover;width: 100%;height: 100%; background-position: center;background-repeat: no-repeat;    border-top-left-radius: 10px;border-top-right-radius: 10px;">';

    			$output .= '</div>';

    			$output .= '</a>';
    			
    			$output .= '<div class="overlay"></div>';
    			
    			$event_strt = $row->event_start_stmp;
    			if($event_strt>$current_time)
                {
                    $output .= '<div class="details-socil" data-countdown="'.$event_strt.'">';
                    $output .= '<p class="1-m1" id="cout-days"></p>';
                    $output .= '<p id="cout-hours"></p>';
                    $output .= '<p id="cout-minutes"></p>';
                    $output .= '<p class="sdgfdy" id="cout-seconds"></p>';
                    $output .= '</div>';    
                }
                
    			$output .= '</div>';

    			$output .= '<div class="event-body">';

    			$output .= '<h4>'.(($lang=="english")?text_limit($row->en_event_title,7):text_limit_ar($row->ar_event_title,20)).'</h4>';

    		 	$output .= '<p>'.(($lang=="english")?strip_tags($row->en_desc):strip_tags($row->ar_desc)).'</p>';

    		    $output .= '<div class="iconTxt">';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/distance.svg".'"><div>'.rtrim($distances," - ").'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/pin.svg".'" ><div>'.$row->event_location.'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/calendar.svg".'"><div>'.str_replace("-", " ", date('d-M-Y', strtotime($row->event_date))).'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/clock.svg".'"><div>'.$row->event_start_time.' - '.$row->event_end_time.'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/money.svg".'"><div>'.$row->price.' KD'.'</div></span>';

    		    $output .= '</div>';

    		    $output .= '<div class="evbtBtn">';

    		    if($event_start_time>$current_time)

                {

                	$output .= '<a href="'.base_url("event/").$row->event_url.'" class="btn btn-block btn-sm btn-primary">'.$this->lang->line('RegisterNow').'</a>';

                }else{

                	$output .= '<a href="'.base_url("event/").$row->event_url.'" class="btn btn-block btn-sm btn-primary view-details-custom-btn">'.$this->lang->line('ViewDetails').'</a>';	

                }

    		    $output .= '</div>';

    			$output .= '</div>';

    			$output .= '</article>';

    			$output .= '</div>'; 

            }

            return $output;

        }

    }

    

    function count_filtered_blogs($categories)

    {

        $qry = "SELECT * FROM `blogs` WHERE `blogs`.`status` = '1' $categories"; 

        $query = $this->db->query($qry);

        return $data = $query->result();

    }

    

    function get_filtered_blogs($perpage,$start,$categories,$sort_str)

    {

        $qry = "SELECT * FROM `blogs` WHERE `blogs`.`status` = '1' $categories $sort_str LIMIT $start $perpage"; 

        $query = $this->db->query($qry);

        $data = $query->result();

        $output = '';

        $lang = $this->session->userdata('site_lang');

        if(!empty($data))

        {

            foreach($data as $row)

            {

                $output .= '<div class="col-sm-6">';

                $output .= '<div class="blog-cardgf">';

                $output .= '<div class="blog-card">';

                $output .= '<div class="blog-img">';

                $output .= '<a href="'.base_url("blog/").$row->blog_url.'">';

                $output .= '<img src="'.base_url()."uploads/blogs/medium/".$row->banner_image.'" alt="">';

                $output .= '</a>';

                $output .= '</div>';

                $output .= '<div class="blog-caed-contect">';

                $output .= '<a href="'.base_url("blog/").$row->blog_url.'" ><h4>'.(($lang=="english")?text_limit($row->blog_title_en,10):text_limit_ar($row->blog_title_ar,10)).'</h4></a>';

                $output .= '<a><p>'.(($lang=="english")?text_limit(strip_tags($row->description_en),20):text_limit_ar(strip_tags($row->description_ar),20)).'</p></a>';

                $output .= '</div>';

                $output .= '<div class="blog-readmore">';

                $output .= '<button type="button"><a href="'.base_url("blog/").$row->blog_url.'" >'.$this->lang->line('ReadMore').'</a></button>';

                $output .= '</div>';

                $output .= '</div>';

                $output .= '</div>';

                $output .= '</div>';

            }

            return $output;

        }

    }

    

    function get_favorites_events($eventsrr)

    {

        $qry = "SELECT `events`.*, `events_details`.`id` as `eved_id`, `events_details`.* FROM `events` 

        JOIN `events_details` ON `events_details`.`event_id` = `events`.`id` WHERE `events`.`status` = '1' $eventsrr

        GROUP BY `events_details`.`event_id` ORDER BY `events`.`id` DESC";

        $query = $this->db->query($qry);

        $data = $query->result();  

        $output = '';

        $lang = $this->session->userdata('site_lang');

        if(!empty($data))

        {

            foreach($data as $row)

            {

                $distances = "";

                $event_id = $row->event_id;

                $qry1 = "SELECT * FROM `events_details` WHERE `event_id` = '$event_id' ORDER BY `id` ASC";

                $que = $this->db->query($qry1);

                $dedata = $que->result();

                foreach($dedata as $key=>$dis)

                {

                    $distances = $distances.$dis->distance." - ";

                }

                $output .= '<div class="col-md-6">';

    			$output .= '<article class="post">';

    			$output .= '<div class="post-media">';

    			$output .= '<a href="'.base_url("event/").$row->event_url.'">';

    			$output .= '<img src="'.base_url()."uploads/Events/medium/".$row->banner_img.'" alt="'.$row->banner_img.'">';

    			$output .= '</a>';

    			$output .= '</div>';

    			$output .= '<div class="event-body">';

    			$output .= '<h4>'.(($lang=="english")?text_limit($row->en_event_title,7):text_limit_ar($row->ar_event_title,20)).'</h4>';

    		 	$output .= '<p>'.(($lang=="english")?strip_tags($row->en_desc):strip_tags($row->ar_desc)).'</p>';

    		    $output .= '<div class="iconTxt">';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/distance.svg".'"><div>'.rtrim($distances," - ").'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/pin.svg".'" ><div>'.$row->event_location.'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/calendar.svg".'"><div>'.str_replace("-", " ", date('d-M-Y', strtotime($row->event_date))).'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/clock.svg".'"><div>'.$row->event_start_time.' - '.$row->event_end_time.'</div></span>';

    		 	$output .= '<span><img src="'.base_url()."assets/front-end/images/icons/money.svg".'"><div>'.$row->price.' KD'.'</div></span>';

    		    $output .= '</div>';

    		    $output .= '<div class="evbtBtn">';

    	 		$output .= '<a href="'.base_url("event/").$row->event_url.'" class="btn btn-block btn-sm btn-primary">'.$this->lang->line('RegisterNow').'</a>';

    		    $output .= '</div>';

    			$output .= '</div>';

    			$output .= '</article>';

    			$output .= '</div>'; 

            }

            return $output;

        }

    }

    

    function get_variations_sizes($product_id)

    {

        $this->db->distinct('size');

        $this->db->select('size');

        $this->db->from('product_variations');

        $this->db->where('product_variations.product_id', $product_id);

        $query = $this->db->get()->result();

        return $query;

    }

    

    function get_products_sizes($sizes)

    {

        $this->db->select('id,name,ar_name');

        $this->db->from('sizes');

        $this->db->where_in('sizes.id', $sizes);

        $query = $this->db->get()->result();

        return $query;

    }

    

    function get_related_products($productID, $category)

    {

        $this->db->select('products.*,product_variations.*,product_variations.id as variation_id');

        $this->db->from('products');

        $this->db->join('product_variations','product_variations.product_id = products.id');

        $this->db->where('products.id !=', $productID);

        $this->db->where('products.category', $category);

        $this->db->where('products.status', '1');

        $this->db->where('product_variations.status', '1');

        $this->db->group_by('product_variations.product_id');

        $this->db->order_by("product_variations.product_id", "DESC");

        $query = $this->db->get()->result();   

        return $query;

    }

    

    function get_random_products()

    {

        $this->db->select('products.*,product_variations.*,product_variations.id as variation_id');

        $this->db->from('products');

        $this->db->join('product_variations','product_variations.product_id = products.id');

        $this->db->where('products.status', '1');

        $this->db->where('product_variations.status', '1');

        $this->db->group_by('product_variations.product_id');

        $this->db->order_by("products.id", "random");

        $this->db->limit(5);

        $query = $this->db->get()->result();   

        return $query;

    }

    

    function get_cart_products($user_id,$user_type) {
        $query = "SELECT `user_cart`.`id` as cart_id,`user_cart`.`user_id`,`user_cart`.`user_type`,`user_cart`.`quantity` as cart_quantity,
        `products`.`id` as product_id,`products`.`name`,`products`.`p_image`,`products`.`titleUrl`,`products`.`mrp`,`products`.`sale`
        FROM `user_cart`
        JOIN `products` ON `products`.`id` = `user_cart`.`product_id`
        WHERE `user_cart`.`user_id` = '$user_id' AND `user_cart`.`user_type` = '$user_type' ";
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
    }
    
    function products_name_filter($keyword)
    {
        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
        AND `product_variations`.`status` = '1' $keyword
        GROUP BY `product_variations`.`product_id`";
        $query = $this->db->query($qry);
        $data = $query->result();
        return $data;
    }

    function get_brands($cats)
    {
        $qry = "SELECT * FROM `brands` WHERE $cats"; 
        $query = $this->db->query($qry);
        $data = $query->result();
        return $data; 
    }

    function get_products_by_types($type,$limittxt)
    {
        $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
                AND `product_variations`.`status` = '1' AND FIND_IN_SET('$type',`products`.`product_type`) GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` $limittxt";
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
        
    }
    function get_popular_salon()
    {
        $query = "SELECT s.*,r.id as ratingId, MAX(r.rates) as rating,r.comments,r.customer_id,r.salon_id FROM `salon` as s LEFT JOIN ratings as r ON s.id=r.salon_id WHERE s.status=1 GROUP BY s.id";
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
    }
    function get_rating_salon($id)
    {
        $this->db->select_max('rates');
        $this->db->where('salon_id', $id);
        $this->db->from('ratings');
        $this->db->group_by('ratings.salon_id');
        $query = $this->db->get();
        $res = $query->result();
        return $res;
    }

    function makequery($cats,$type,$limit, $start, $name, $area)
    {
        $this->db->select('*');
        $this->db->where('status', 1);
        if(empty($type) && !empty($cats)){
            $this->db->where('find_in_set("'.$cats.'", categories) <> 0');
        }if(empty($cats)  && !empty($type)){
            $this->db->where('service_type', $type);
        }if(!empty($cats)  && !empty($type)){
            $this->db->where('find_in_set("'.$cats.'", categories) <> 0');
            $this->db->where('service_type', $type);
        }if(!empty($area)){
            $this->db->where('area', $area);
        }
        if(!empty($name)){
            $this->db->like('name_en', $name);
        }
        $this->db->from('salon');
        if(!empty($start) || !empty($limit))
		{ 
		   $this->db->limit($limit,$start);
		}
        $qry = $this->db->get();

        // $query = "SELECT `salon`.* WHERE `salon`.`status` = '1' AND FIND_IN_SET('$cats',`salon`.`categories`)";
        return $qry;
        
    }
    function get_salon_collection($cats, $type, $limit, $start, $name, $area)
	{
		$query1 = $this->makequery($cats, $type, $limit, $start, $name, $area);
        $query = $query1->result();
        if(!empty($query)){
            $arrResult = $query;
        }else{
            $arrResult = '';
        }
        return $arrResult;
	}

    function countAll()
	{
		$query = $this->makequery($cats='', $type='', $limit='', $start='', $name='', $area='');
		$data = $query->result_array();
		//print_r(count($data));exit;
		return count($data);
	}

    public function uploadImages($audiofile, $folder) {
        $this->makedirs($folder);
        $data = array();
        $countfiles = count($_FILES['files']['name']);
        for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['files']['name'][$i])){
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                // Set preference
                $config['upload_path'] = 'uploads/' . $folder; 
                $config['allowed_types'] = '*';
                $config['max_size'] = '1024000'; 
                $config['file_name'] = $_FILES['files']['name'][$i];

                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data['filenames'][] = $filename;
                }else{
                    $data['error'][] = array('error' => $this->upload->display_errors());
                }
            }
        }
        return $data;
    }

    public function updateSalonGallery($id){
        $condition = array();
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('salon');
        $condition['salon.id'] = $id;
        $this->db->where($condition);
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    public function updateSalonData($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('salon', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }
    function get_all_order_data($tbl,$fromDate,$toDate)
    {
        $qry = "SELECT * FROM `$tbl` WHERE `status` = '7' AND `payment_status` = '2' AND `booking_date` BETWEEN '$fromDate' AND '$toDate' ";
        $query = $this->db->query($qry);
        $data = $query->result();
        return $data;
        
    }
    function get_all_filter_order_data($tbl,$fromDate,$toDate,$status)
    {
        $fromDate = date('Y-m-d',strtotime($fromDate));
        $toDate = date('Y-m-d',strtotime($toDate));
        $this->db->select('*');
        $this->db->from($tbl);
        if(!empty($status)){
            $this->db->where('status',$status);
        }
        if(!empty($fromDate) && !empty($fromDate)){
            
            $this->db->where("orders.booking_date BETWEEN '$fromDate' AND '$toDate'");
        }
        $query = $this->db->get();
        $data = $query->result();
        return $data;
        
        
    }
    function get_product_data($id)
    {
        $query = "SELECT `item_price`.* FROM `item_price` 
                WHERE `item_price`.`status` = '1' 
                AND `item_price`.`id` = '$id' ORDER BY `item_price`.`id`";
        $qry = $this->db->query($query);
        $data = $qry->row();
        return $data;
        
    }
    function get_cart_items($productID)
    {
        $this->db->select('item_price.*');
        $this->db->from('item_price');
        $this->db->where('item_price.id', $productID);
        $this->db->order_by("item_price.id", "DESC");
        $query = $this->db->get()->row();
        return $query;

    }
    function deleteAllRecords($tbl)
    {
        $this->db->empty_table($tbl);
        return true;
    }
    /*----------------------*/
    function getRows($tbl,$params = array()){
        $this->db->select('*');
        $this->db->from($tbl);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($tbl,$data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("create_date", $data)){
                $data['create_date'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("update_date", $data)){
                $data['update_date'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($tbl, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($tbl, $data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("update_date", $data)){
                $data['update_date'] = date("Y-m-d H:i:s");
            }
            // Update member data
            $update = $this->db->update($tbl, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
    
    
    


/*Main Class Ended*/    

}