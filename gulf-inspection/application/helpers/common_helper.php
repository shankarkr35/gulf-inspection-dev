<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Helper function to check whether the url slug already exists
 */
if(!function_exists('isUrlExists')){
    function isUrlExists($tblName, $urlSlug , $coloum_name){
         if(!empty($tblName) && !empty($urlSlug)){
            $ci = & get_instance();
            $ci->db->from($tblName);
            $ci->db->where($coloum_name,$urlSlug);
            $rowNum = $ci->db->count_all_results();
            return ($rowNum>0)?true:false;
        }else{
            return true;
        }
    }
}

function discount_percentage($mrp,$sale)
{
    $res = (($mrp - $sale) / $mrp) * 100;
    return number_format($res)."% OFF";    
}

function discount_price($mrp,$sale)
{
    $res = (($mrp - $sale) / $mrp) * 100;
    return number_format($res);    
}

function get_percent($percentage,$percentage_of)
{
    $res = $percentage/100*$percentage_of;  
    return $res;
}

function text_limit($text, $limit) 
{
  if (str_word_count($text, 0) > $limit) 
  {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]) . '..';
  }
  return $text;
}

function text_limit_ar($str, $limit) {
    return '...'.mb_substr($str, 0, $limit - 3, "UTF-8");
}


function check_product_incart($user,$usertype,$product)
{
    $ci = & get_instance();
    $ci->db->from("user_cart");
    $ci->db->where("user_id",$user);
    $ci->db->where("user_type",$usertype);
    $ci->db->where("product_id",$product);
    
    $query = $ci->db->get();
    $rates_arr = $query->row();
    //echo"<pre>";print_r($rates_arr);die;
    if(!empty($rates_arr))
    {
        return 1;
    }else{
        return 0;
    }
    
}

function check_product_inwish($user,$product,$variation)
{
    $ci = & get_instance();
    $ci->db->from("customers_wishlist");
    $ci->db->where("user_id",$user);
    $ci->db->where("product_id",$product);
    $ci->db->where("variation_id",$variation);
    $query = $ci->db->get();
    $rates_arr = $query->row();
    if(!empty($rates_arr))
    {
        return 1;
    }else{
        return 0;
    }
    
}

function check_event_fav($user,$event_id)
{
    $ci = & get_instance();
    $ci->db->from("customer_favorite_events");
    $ci->db->where("customer_id",$user);
    $ci->db->where("event_id",$event_id);
    $query = $ci->db->get();
    $rates_arr = $query->row();
    if(!empty($rates_arr))
    {
        return 1;
    }else{
        return 0;
    }
    
}

function time_ago($datetime, $full = false) {
    date_default_timezone_set('Asia/Kuwait');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function get_record($tbl,$col,$id)
{
    $ci = & get_instance();
    $ci->db->from($tbl);
    $ci->db->where($col,$id);
    $query = $ci->db->get();
    $rates_arr = $query->row();
    if(!empty($rates_arr))
    {
        return $rates_arr;
    }else{
        return '';
    }
    
}

function active_currency($currency)
{
    if($currency=='KWD'){
        return 1;
    }else{
        $ci = & get_instance();
        $ci->db->from('countries');
        $ci->db->where('currency_code',$currency);  
        $query = $ci->db->get();
        $array = $query->row();
        return $array->currency_value;
    }
}




