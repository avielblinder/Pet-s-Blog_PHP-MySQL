<?php

require_once 'db_config.php';

if(!function_exists('old')){//checking if the function name exist
  
  /*
    * Keeping the previous input value.
    * 
    *@param string $op input name
    *@return string
  */
  function old($op){
    return $_REQUEST[$op] ?? '';//its expected also POST or GET
  }
}

if( ! function_exists('email_exist') ){

  /*
    * Checking if email exist.
    * 
    *@param string $link get the database linked
    *@param string $email get the email you want to check 
    *@return boolean
  */
  function email_exist($link, $email){

    $exist = false;
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);

    if( $result && mysqli_num_rows($result) > 0 ){

      $exist = true;

    }

    return $exist;

  }

}

if( ! function_exists('validate_image')){

  /*
    * Checking if image valid.
    * 
    *@param array $files gets the upload file array
    *@return boolean
  */ 
  function validate_image($files){
    
    $valid = false;
    $max_size = 1024 * 1024 * 5;//1024 bytes * 1024 kb
    $ex = ['png', 'jpg', 'jpeg', 'gif','bmp','svg'];
    
    if($files['image']['size'] <= $max_size){
      
      $file_info = pathinfo($files['image']['name']);//return the file information 
      
      if( in_array(strtolower($file_info['extension']),$ex) ){//check if the extension is in the array

        if( is_uploaded_file($files['image']['tmp_name']) ){//if the file is just upload or already exist against     hackers
          
          $valid = true;

        }
        
      }

    }

    return $valid;

  }
  
}

if( ! function_exists('str_rand')){ 

 /*
    * Replay with random string.
    * 
    *@param number $len number of chars
    *@param default 30 
    *@return string
  */ 
  function str_rand($len = 30){

    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $str_random = '';
    $max = strlen($chars) - 1;
  
    for( $x = 0; $x < $len; $x++ ){
  
      $str_random .= $chars[rand(0, $max)];
  
    }
  
    return $str_random;
    
  }
}


#