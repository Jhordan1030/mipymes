<?php
include 'Database.php';
include 'Nota.php';

class NotaModel {
    public function getNotas() {
        $pdo = Database::connect();
        $sql = "select * from notas order by nombres";
        $resultado = $pdo->query($sql);
        $listado = array();
        
        foreach ($resultado as $res) {
            $nota = new Nota();
            $nota->setCedula($res['cedula']);
            $nota->setNombres($res['nombres']);
            $nota->setNota1($res['nota1']);
            $nota->setNota2($res['nota2']);
            $nota->setPromedio($res['promedio']);
            array_push($listado, $nota);
        }
        Database::disconnect();
        return $listado;
    }
    public function getNotasDesc() {
        $pdo = Database::connect();
        $sql = "select * from notas order by nombres DESC";
        $resultado = $pdo->query($sql);
        $listado = array();
        
        foreach ($resultado as $res) {
            $nota = new Nota();
            $nota->setCedula($res['cedula']);
            $nota->setNombres($res['nombres']);
            $nota->setNota1($res['nota1']);
            $nota->setNota2($res['nota2']);
            $nota->setPromedio($res['promedio']);
            array_push($listado, $nota);
        }
        Database::disconnect();
        return $listado;
    }
    public function calcularPromedioGeneral() {
        $pdo = Database::connect();
        $sql = "SELECT AVG(promedio) as promedio_general FROM notas";
        $resultado = $pdo->query($sql);
        $dato = $resultado->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $dato['promedio_general'];
    }
    
    public function getNota($cedula) {
        $pdo = Database::connect();
        $sql = "select * from notas where cedula=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        $nota = new Nota();
        $nota->setCedula($dato['cedula']);
        $nota->setNombres($dato['nombres']);
        $nota->setNota1($dato['nota1']);
        $nota->setNota2($dato['nota2']);
        $nota->setPromedio($dato['promedio']);
        Database::disconnect();
        return $nota;
    }
    

    public function crearNota($cedula, $nombres, $nota1, $nota2) {
        $promedio = ($nota1 + $nota2) / 2;
        $pdo = Database::connect();
        $sql = "INSERT INTO notas (cedula, nombres, nota1, nota2, promedio) VALUES (?, ?, ?, ?, ?)";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$cedula, $nombres, $nota1, $nota2, $promedio]);
        Database::disconnect();
    }

    public function eliminarNota($cedula) {
        $pdo = Database::connect();
        $sql = "DELETE FROM notas WHERE cedula = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$cedula]);
        Database::disconnect();
    }

    public function actualizarNota($cedula, $nombres, $nota1, $nota2) {
        $promedio = ($nota1 + $nota2) / 2;
        $pdo = Database::connect();
        $sql = "UPDATE notas SET nombres = ?, nota1 = ?, nota2 = ?, promedio = ? WHERE cedula = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$nombres, $nota1, $nota2, $promedio, $cedula]);
        Database::disconnect();
    }
    public function existeCedula($cedula) {
        $pdo = Database::connect();
        $sql = "SELECT COUNT(*) FROM notas WHERE cedula = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$cedula]);
        $existe = $consulta->fetchColumn() > 0;
        Database::disconnect();
        return $existe;
    }
    public function resetearNotas() {
        $pdo = Database::connect();
        $sql = "UPDATE notas SET nota1 = 0, nota2 = 0, promedio = 0";
        $pdo->exec($sql);
        Database::disconnect();
    }
   
    
}
?>
