<?php
// Inclusión de TWIG
require_once './vendor/autoload.php';

// Definición del directorio de los templates
$templateDir=dirname(__FILE__).'/templates/';

if (isset($_COOKIE['userName'])){
    $cookie = $_COOKIE['userName'];
    
    if ($cookie!='')
    {
        // Api de pruebas en local
        $url="http://localhost/api2/api/public/api/v1/access";
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $fields = Array("userName"=>$cookie);
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
        
        if ($resultData->error==0)
        {
            $loader = new Twig_Loader_Filesystem($templateDir);
            $twig = new Twig_Environment($loader);
            
            //echo $twig->render('index', array('name' => 'Fabien'));
            $template = $twig->load('spacecrafts.html');
        }
        else
            header("Location:index.html");
        
    }
    else
        header("Location:index.html");
}
else
    header("Location:index.html");
?>