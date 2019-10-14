<?php

include_once('config.php');

$curl = curl_init();
$auth    = API_AUTH_USER . ":" . API_AUTH_PSWD;
curl_setopt_array($curl, array(
  CURLOPT_PORT => "8442",
  CURLOPT_URL => "https://private.qa.api.dsv.com:8442/v1/ExternalBooking/UpdateBookingRequest?ReferenceNo=DX190904_393&RequestType=1&DivisionCode=MSD&CustomerGroupCode=RECO&DeliveryTownCode=RDB&DeliverySuburb=RANDBURG&ClientName=Mdu%20Mdluli&ClientIDPassport=9603025469085&ClientContactNo=0845889677&ClientDeliveryAddress1=Ncondo%20Place&ClientDeliveryAddress2=Ncondo%20Place&ClientDeliveryAddress3=Ncondo%20Place&ReferenceType=1&ReferenceValue=00013784147&DeliveryPostalCode=4320&DeliveryCountryCode=ZA&DeliveryDateTime=2019-09-13T00:00:00&TripSheetID=M8RD204M012709201905000&TripServiceTime=12:00PM%20-%20%202:00PM&NotificationSMS=false&NotificationEmail=false&NotificationCalendar=false&DeliveryType=1&DeliveryProvinceCode=3&ThirdPartyDelivery=false&ActionUser=peterh&StatusID=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST=> 0,
  CURLOPT_SSL_VERIFYPEER=> 0,
  CURLOPT_HTTPAUTH, CURLAUTH_BASIC,
  CURLOPT_USERPWD =>$auth,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  // CURLOPT_HTTPHEADER => array(
  //   "Accept: */*",
  //   "Accept-Encoding: gzip, deflate",
  //   "Cache-Control: no-cache",
  //   "Connection: keep-alive",
  //   "Content-Length: ",
  //   "Host: private.qa.api.dsv.com:8442",
  //   "Postman-Token: c1da0547-887a-4c38-b316-f3e6352ca14c,e6980b3e-2b89-4954-8448-63f0052b08e6",
  //   "User-Agent: PostmanRuntime/7.16.3",
  //   "cache-control: no-cache"
  // ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}