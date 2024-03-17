<?php
    function callFortniteAPI($endpoint){
        $apiKey = 'd7d4a567-365e-416b-9f6e-5bc58446fc4f';
        $baseUrl = 'https://fortnite-api.com/v2/';
        $url = $baseUrl . $endpoint;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $apiKey
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data ? $data : [];
    }