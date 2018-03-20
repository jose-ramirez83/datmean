<?php
class curlApi{
    private $_url= "";
    private $_ch = "";
    
    public function sendDataPOST($url="http://localhost/api2/api/public/api/v1/",$data=""){
        $this->_url = $url;
        $this->_ch = curl_init();
        // Disable SSL verification
        curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, "POST");
        // Will return the response, if false it print the response
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($this->_ch, CURLOPT_URL,$this->_url);
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $data);
        // Execute
        $result=curl_exec($this->_ch);
        // Closing
        curl_close($this->_ch);
        return $result;
    }
    
    public function getData($url="http://localhost/api2/api/public/api/v1/"){
        $this->_url = $url;
        $this->_ch = curl_init();
        // Disable SSL verification
        curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($this->_ch, CURLOPT_URL,$this->_url);
        // Execute
        $result=curl_exec($this->_ch);
        // Closing
        curl_close($this->_ch);
        return $result;
    }
    
}