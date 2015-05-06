<?php
// Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $id,// Array ids
            'data' => $load,// Array some data to send
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );


        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, true));

        // Execute post

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $status = "";
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
            $status = "FAIL";
        }

        $report = array();
        // Close connection
        curl_close($ch);
        //echo $result; //if you want to print the pure result
        //print_r($id);
        $jsonText = preg_replace('/\s+/', '', $result);
        $decodedText = html_entity_decode($jsonText);
        $myArray = json_decode($decodedText, true);

        echo var_dump($myArray);//The result a bit cleaner
?>