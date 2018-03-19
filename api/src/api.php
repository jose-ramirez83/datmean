<?php

function getAuthorization($request,$response)
{
    $user = $request->getParsedBody();
    
    $password = base64_encode(md5($user['pass']));
    
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
    $sql = "SELECT * FROM type";
    try {
        $stmt = getConnection()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $data->error=0;
        
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getShips($response) {
    $sql = "SELECT * FROM ships";
    try {
        $stmt = getConnection()->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $data->error=0;
        
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function registerSpaceship($request) {
    $spaceship = json_decode($request->getBody());
    
    $sql = "INSERT INTO spaceship (name, id_type, x, y, z) VALUES (:name, :id_type, :x, :y, :z)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $spaceship->name);
        $stmt->bindParam("id_type", $spaceship->type);
        $stmt->bindParam("x", $spaceship->x);
        $stmt->bindParam("y", $spaceship->y);
        $stmt->bindParam("z", $spaceship->z);
        $stmt->execute();
        $spaceship->id = $db->lastInsertId();
        $spaceship->error = 0;
        $db = null;
        echo json_encode($spaceship);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>