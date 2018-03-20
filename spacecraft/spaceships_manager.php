<?php
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
        
        $result = $curlApi->sendDataPOST("http://localhost/api2/api/public/api/v1/access",$fields);
        
        $resultData = json_decode($result);
        
        if ($resultData->error==0)
        {
            switch ($accion){
                case "enter":
                    $loader = new Twig_Loader_Filesystem($templateDir);
                    $twig = new Twig_Environment($loader);
                    
                    //echo $twig->render('index', array('name' => 'Fabien'));
                    $template = $twig->load('spacecrafts.html');
                    
                    // Llamada a la API para cargar la flota rebelde
                    $result = $curlApi->getData("http://localhost/api2/api/public/api/v1/rebelShips");
                    $resultData = json_decode($result);
                    
                    // Llamada a la API para cargar los tipos de naves espaciales
                    $resultTypes = $curlApi->getData("http://localhost/api2/api/public/api/v1/typeShips");
                    
                    $resultDataTypes = json_decode($resultTypes);
                    
                    echo $template->render(Array('naves'=>$resultData,'typeShips'=>$resultDataTypes));
                    break;
                default:
                    header("Location:index.html");
                    break;
            }
            
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