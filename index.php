<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// include files
require_once 'config.php';
require_once 'functions.php';


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
    case 'LogEvent':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = logEvent($postData);
        break;
    case 'CancelBookingRequest':
        $postData = (array) json_decode(file_get_contents('php://input'));
        $json = cancelBookingRequest($postData);
        break;
    default:
        $json['code']    = 401;
        $json['message'] = 'Forbidden';
}

// return JSON results
echo (gettype($json) === 'string') ? $json : json_encode($json);