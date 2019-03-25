<?php
namespace Knesk\Framework;

class Response {

	/**
     * Get User Object by Email
     *
     * @param  string  $email
     * @return object
    */
    public static function error($code, $error, $message, $append=array()) {
        
        $response = [
            "status_code" => $code,
            "message" => $message,
            "error" => $error
        ];

        $response = array_merge($response, $append);

        return $response;
    }


    public static function ok($code, $success=true, $message=null, $append=array()) {
        
        $response = [
            "status_code" => $code,
            "message" => $message,
            "success" => $success
        ];

        $response = array_merge($response, $append);
        return $response;
    }

    public static function error_json($code, $error, $message, $append=array()) {
        
        $response = [
            "status_code" => $code,
            "message" => $message,
            "error" => $error
        ];

        $response = array_merge($response, $append);

        
        return json_encode($response);
    }


    public static function ok_json($code, $success, $message, $append=array()) {
        
        $response = [
            "status_code" => $code,
            "message" => $message,
            "success" => $success
        ];

        $response = array_merge($response, $append);
        
        
        return json_encode($response);
    }

}