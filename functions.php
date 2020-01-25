<?php

Class SendSMS {
    private $username,$apikey;

    public function __construct(){
        $this->username = "azahub";
        $this->apikey   = "ami_Pjzh7t0TizbW9Afs0HXAJqKgOkSpxJprczJKfkUZ8gVBE";
    }
    public function sendMessage($phone,$message){
        $params = array(
            "phoneNumbers" => $phone, // phone numbers comma separated
            "message"      => $message,
            "senderId"     => "", // leave blank if you do not have a custom sender Id
        );

        $data = json_encode($params);

        // endoint
        $sendMessageURL     = "https://api.amisend.com/v1/sms/send";

        $req                  = curl_init($sendMessageURL);

        curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($req, CURLOPT_TIMEOUT, 60);
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($req, CURLOPT_POSTFIELDS, $data);
        curl_setopt($req, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'x-api-user: '.$this->username,
            'x-api-key: '.$this->apikey
        ));

        // read api response
        $res              = curl_exec($req);

        // close curl
        curl_close($req);

    }
}