<?php

require_once 'curl.php';

function getTimeSlots($data) {
    var_dump($data);
    return ['name'=>'Mududuzi'];
}

function bookingAvailability($data) {
    
    return curlPost('ExternalBooking/BookingAvailability', $data);
}

function getBookingRequest($data){
    return curlPost('ExternalBooking/GetBookingRequest', $data);
}

function updateBookingRequest($data){
    return curlPost('ExternalBooking/UpdateBookingRequest', $data);
}
function logEvent($data){
    return curlPostEpic('LogEvent', $data);
}
function createBookingRequest($data){
    return curlPost('ExternalBooking/BookingRequest', $data);
}
function cancelBookingRequest($data){
    return curlPost('ExternalBooking/CancelBookingRequest', $data);
}