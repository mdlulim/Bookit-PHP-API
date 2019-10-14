<?php

    function curlPost($uri, $data) {
        $data['DivisionCode']      = DSV_API_DIVISION_CODE;
        $data['CustomerGroupCode'] = DSV_API_CUSTOMER_CODE;

        $baseurl = API_BASE_URL . $uri;
        $data    = http_build_query($data);
        $curlUrl = "$baseurl?$data";
        $auth    = API_AUTH_USER . ":" . API_AUTH_PSWD;

        try {
            $ch = curl_init(); 
            if ($ch === false) {
                throw new Exception('failed to initialize');
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $auth);
            curl_setopt($ch, CURLOPT_URL, $curlUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT , 30);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        
            //curl_setopt(/* ... */);

            $content = curl_exec($ch);
            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }
            curl_close($ch);
            return $content;
        } catch(Exception $e) {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR
            );

        }
    }

    function curlPostEPIC($uri, $data) {
        $data['DivisionCode']      = DSV_API_DIVISION_CODE;
        $data['CustomerGroupCode'] = DSV_API_CUSTOMER_CODE;

        $baseurl = EPIC_API_BASE_URL . $uri;
        $data    = http_build_query($data);
        $curlUrl = $baseurl;
        $auth    = EPIC_API_AUTH_USER . ":" . EPIC_API_AUTH_PSWD;
        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data)),
        );

        try {
            $ch = curl_init(); 
            if ($ch === false) {
                throw new Exception('failed to initialize');
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $auth);
            curl_setopt($ch, CURLOPT_URL, $curlUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT , 30);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        
            //curl_setopt(/* ... */);

            $content = curl_exec($ch);
            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }
            curl_close($ch);
            return $content;
        } catch(Exception $e) {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR
            );

        }
    }