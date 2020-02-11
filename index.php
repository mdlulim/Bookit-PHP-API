<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// include files
require_once 'config.php';
require_once 'functions.php';
require_once 'classes/users.class.php';


$function = filter_input(INPUT_GET, 'function', FILTER_SANITIZE_STRING);
$json     = array();


switch ($function) {
    case 'GetTimeSlots':
        $json = getTimeSlots(filter_input_array(INPUT_POST));
        break;

    case 'BookingAvailability':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = bookingAvailability($postData);
        break;

    case 'GetBookingRequest':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = getBookingRequest($postData);
        break;

    case 'UpdateBookingRequest':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = updateBookingRequest($postData);
        break;
            
    case 'BookingRequest':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = createBookingRequest($postData);
        break; 

    case 'AdminLogin':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->login($postData);
        break; 
    case 'AdminUsers':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->getUsers($postData);
        break; 
    case 'AdminSearchUsers':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->searchUsers($postData);
        break; 
    case 'AdminAddUser':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->addUser($postData);
        break; 
    case 'AdminUpdateUser':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->updateUser($postData);
        break; 
    case 'AdminResetPassword':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->resetPassword($postData);
        break; 
    case 'AdminChangePassword':
        $users = new Users();
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = $users->changePassword($postData);
        break; 
    case 'AdminLastLogin':
        // $users = new Users();
        // $postData = (array) json_decode(file_get_contents('php://input'));
        // $json = $users->lastLogin($postData);
        $json['success'] = true;
        break; 
    default:
        $json['code']    = 401;
        $json['message'] = 'Forbidden';
}

// return JSON results
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Content-Type: application/json");
echo (gettype($json) === 'string') ? $json : json_encode($json);