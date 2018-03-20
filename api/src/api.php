<?php

function getAuthorization($request,$response)
{
    $user = $request->getParsedBody();
    
    $password = base64_encode(md5($user['pass']));
    
    // La contraseņa es dagobah
    if ($password=="N2FkNTY4YzQ4MWY1ZDA2OTc0MWZjYjllYmY4MDUwMDc="){
        
        $sql = "INSERT INTO token (user) VALUES (:user)";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("user", $user['name']);
            $stmt->execute();
            $user['id'] = $db->lastInsertId();
            $user['error'] = 0;
            $cookie_name = 'userName';
            $cookie_value = $user['id'];
            
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

function accesPlataform($request)
{
    $user = $request->getParsedBody();
    
    $sql = "SELECT COUNT(*) FROM token WHERE id=:id";
    
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $user['userName']);
        $stmt->execute();
        $user['id'] = $db->lastInsertId();
        $user['error'] = 0;
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

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

function registerSpaceship($request) {
    //$spaceship = json_decode($request->getBody());
    $spaceship = $request->getParsedBody();
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
        echo json_encode($spaceship);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

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
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if ($count>0){
            $data->error = 0;
        }
        else{
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