<?php
$_COOKIE['userName']="2";
$cookie = $_COOKIE['userName'];
if (isset($cookie)&&$cookie!='')
{
    // Api de pruebas en local
    $url="http://localhost/api2/api/public/api/v1/access";
    //  Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    $fields = json_encode(Array("userName"=>$cookie));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    
    // Closing
    curl_close($ch);
    
    $resultData = json_decode($result);
    
    echo $resultData->msg;die();
    
?>
  
<?php
}
else
    header("Location:index.html");
?>