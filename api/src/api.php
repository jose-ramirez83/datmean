<?php

use Slim\Http\Response;
use Slim\Http\Request;

/*
 * Registra en la base de datos el registro de un usuario con la contraseña del sistema
 * Le adjudica una cookie de 1 hora de duración para realizar las operaciones pertinentes
 * Esta cookie es utilizada posteriormente para acceder al sistema
 * 
 */
function getAuthorization($request,$response)
{
    $user = $request->getParsedBody();
  
    // La contraseña se encripta con md5 y en base 64.
    $password = base64_encode(md5($user['pass']));
    
    // La contraseña es dagobah
    if ($password=="N2FkNTY4YzQ4MWY1ZDA2OTc0MWZjYjllYmY4MDUwMDc="){
        
        $sql = "INSERT INTO token (user,token,fc_acceso) VALUES (:user,:token,:time)";
        try {
            $time= date('Y-m-d H:i:s');
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $cookie_name = 'userName';
            $cookie_value = base64_encode(md5($user['name']));
            $stmt->bindParam("user", $user['name']);
            $stmt->bindParam("token", $cookie_value);
            $stmt->bindParam("time", $time);
            $stmt->execute();
            $user['id'] = $db->lastInsertId();
            $user['error'] = 0;
            
            // Preparamos una cookie durante 15 minutos
            setcookie($cookie_name, $cookie_value, time() + (60 * 15), "/"); // 60 segundos (1 minuto) por 15
            $db = null;
            echo json_encode($user);
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
    else{
        $unauthorized = $response->withStatus(403)->write('{"error":{"text":Unathorized}}');
        return $unauthorized;
    }
}

/**
 * Función de acceso a la plataforma que comprueba que el identificador de la tabla token coincida con la cookie del usuario
 * 
 * @param Request $request
 */
function accesPlataform($request)
{
    $user = $request->getParsedBody();
    
    $sql = "SELECT COUNT(*) FROM token WHERE token=:token";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $cookie = 
        $stmt->bindParam("token", $user['userName']);
        $stmt->execute();
        $user['id'] = $db->lastInsertId();
        $user['error'] = 0;
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/**
 * Función que devuelve los tipos de naves espaciales
 * 
 * @param Response $response
 * @return string
 */
function getTypeShip($response) {
    $sql = "SELECT id,type,ds_type FROM type";
    try {
        $stmt = getConnection()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/**
 * 
 * Función que devuelve la flota rebelde al completo
 * 
 * @param Response $response
 * @return string
 */
function getShips($response) {
    $sql = "SELECT t.ds_type,sp.name,sp.id_type,sp.x,sp.y,sp.z FROM spaceship sp 
        INNER JOIN type t ON sp.id_type=t.id";
    try {
        $stmt = getConnection()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/**
 * 
 * Función de inserción en la base de datos que registra una nave espacial, dados unos parámetros:
 * Nombre, tipo, coordenadas x, y ,z
 * 
 * @param Request $request
 * @param Response $response
 * @return object
 */
function registerSpaceship($request,$response) {
    //$spaceship = json_decode($request->getBody());
    $spaceship = $request->getParsedBody();
    if ($spaceship["name"]=='' || $spaceship["type"]=='' || $spaceship["x"]== '' || $spaceship["y"] == '' || $spaceship["z"] == ''){
        $unauthorized = $response->withStatus(204)->write('{"error":{"text":No Content}}');
        return $unauthorized;
    }
    else{
        //print_r($request->getParsedBody());die();
        
        $sql = "INSERT INTO spaceship (name, id_type, x, y, z) VALUES (:name, :id_type, :x, :y, :z)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("name", $spaceship["name"]);
            $stmt->bindParam("id_type", $spaceship["type"]);
            $stmt->bindParam("x", $spaceship["x"]);
            $stmt->bindParam("y", $spaceship["y"]);
            $stmt->bindParam("z", $spaceship["z"]);
            $stmt->execute();
            $spaceship["id"] = $db->lastInsertId();
            $spaceship["error"] = 0;
            $db = null;
            //echo json_encode($spaceship);
            $created = $response->withStatus(201)->write('{"error":"0"}');
            return $created;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }
   
}

/**
 * 
 * Función que dado un patrón de búsqueda (una string), hace una búsqueda en la base de datos para devolver
 * la información de las coordenadas de las naves espaciales
 * 
 * @param Request $request
 */
function searchShip($request) {
    $searchText = $request->getAttribute('search');
    //$spaceship = json_decode($request->getBody());
    //$spaceship = $request->getParsedBody();
    
    $sql = "SELECT sp.id,sp.name,sp.id_type,sp.x,sp.y,sp.z 
            FROM spaceship sp WHERE sp.name LIKE ?";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $params = array("%$searchText%");
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if ($count==0){
            $data = new stdclass();
            $data->error = 1;
        }
        $db = null;
        echo json_encode($data);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>