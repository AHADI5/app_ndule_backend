<?php

    class Authentification{
        public static function generate_verification_code (){
            $code = mt_rand(100000,999999);
            return $code;
        }
        public static function send_verification_code ($email, $verification_code) {
            $reciever = $email;
            $subject = 'Verification code';
            $message = "Your verification code is ".$verification_code;
            $headers = "From: <ndule204@gmail.com>";
            if (mail($reciever, $subject, $message,$headers)) {
               return true;
            } else{
                return false;
            }
            
        }
    
        public static function verifying_code($user_code, $generated_code) {
        
            if ($user_code==$generated_code){
                header('location:new_pass.php');
            }
            else{
                echo 'error code incorrect';
            }
        
        }
    }

?>