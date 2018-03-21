<?php
define("API","http://localhost/api2/api/public/api/v1/");

// Inclusión de TWIG
require_once './vendor/autoload.php';

// Para cargar las clases automáticamente
spl_autoload_register(function ($nombre_clase) {
    include  './classes/'.$nombre_clase . '.php';
});

// Definición del directorio de los templates
$templateDir=dirname(__FILE__).'/templates/';

$accion = isset($_REQUEST['accion'])?$_REQUEST['accion']:"";

if (isset($_COOKIE['userName'])){
    $cookie = $_COOKIE['userName'];
    
    if ($cookie!='')
    {
        $fields = Array("userName"=>$cookie);
        // Api de pruebas en local
        $curlApi= new curlApi();
        
        $result = $curlApi->sendDataPOST(API."access",$fields);
        
        $resultData = json_decode($result);
        
        if ($resultData->error==0)
        {
            switch ($accion){
                case "enter":
                    $loader = new Twig_Loader_Filesystem($templateDir);
                    $twig = new Twig_Environment($loader);
                    
                    // Cargamos la plantilla del gestor de naves espaciales
                    $template = $twig->load('spacecrafts.html');
                    
                    // Llamada a la API para cargar la flota rebelde
                    $result = $curlApi->getData(API."rebelShips");
                    $resultData = json_decode($result);
                    
                    // Llamada a la API para cargar los tipos de naves espaciales
                    $resultTypes = $curlApi->getData(API."typeShips");
                    
                    $resultDataTypes = json_decode($resultTypes);
                    
                    echo $template->render(Array('naves'=>$resultData,'typeShips'=>$resultDataTypes));
                    break;
                case "exit":
                    setcookie("userName", '', time()-1000);
                    header("Location:.");
                default:
                    header("Location:.");
                    break;
            }
            
        }
        else
            header("Location:.");
        
    }
    else
        header("Location:.");
}
else
    header("Location:.");
?>