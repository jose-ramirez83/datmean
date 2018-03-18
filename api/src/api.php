<?php
function getData($response) {
    //$sql = "SELECT * FROM empleados";
    try {
        /*$stmt = getConnection()->query($sql);
         $employees = $stmt->fetchAll(PDO::FETCH_OBJ);
         $db = null;*/
        
        $result = new stdClass();
        
        $result->error=0;
        $result->msg="Datos correctos";
        
        return json_encode($result);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
?>