<?php
include 'Database.php';
include 'Nota.php';


class NotaModel
{

    public function getNota()
    {
        // Obtenemos la información de la base de datos
        $pdo = Database::connect();
        $sql = "SELECT * FROM notas ORDER BY nombres";
        $resultado = $pdo->query($sql);

        // Transformamos los registros en objetos de tipo Nota
        $listado = array();
        foreach ($resultado as $res) {
            $nota = new Nota();
            $nota->setCedula($res['cedula']);
            $nota->setNombres($res['nombres']);
            $nota->setNota1($res['nota1']);  // Cambiado de 'lib_año' a 'nota1'
            $nota->setNota2($res['nota2']);
            $nota->setPromedio($res['promedio']);
            array_push($listado, $nota);
        }

        // Cerramos la conexión a la base de datos
        Database::disconnect();

        // Retornamos el listado resultante
        return $listado;
    }



    public function getNotas($cedula)
    {
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "SELECT * from notas where cedula=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($cedula));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $nota = new Nota();
        $nota->setCedula($dato['cedula']);
        $nota->setNombres($dato['nombres']);
        $nota->setNota1($dato['nota1']);
        $nota->setNota2($dato['nota2']);
        $nota->setPromedio($dato['promedio']);
        Database::disconnect();
        return $nota;
    }

    public function crearNota($cedula, $nombres, $nota1, $nota2)
    {
        // Preparamos la conexión a la base de datos
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparamos la sentencia SQL para insertar los datos (sin promedio, ya que se calcula automáticamente)
        $sql = "INSERT INTO notas (cedula, nombres, nota1, nota2) VALUES (?, ?, ?, ?)";
        $consulta = $pdo->prepare($sql);

        // Ejecutamos y pasamos los parámetros
        try {
            $consulta->execute(array($cedula, $nombres, $nota1, $nota2));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }

        // Desconectamos de la base de datos
        Database::disconnect();
    }

    public function eliminarNota($cedula)
    {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE from notas where cedula=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cedula));
        Database::disconnect();
    }

    public function actualizarNota($cedula, $nombres, $nota1, $nota2)
    {
        // Preparamos la conexión a la base de datos
        $pdo = Database::connect();

        // Sentencia SQL para actualizar los datos, el promedio se calcula automáticamente
        $sql = "UPDATE notas SET nombres = ?, nota1 = ?, nota2 = ? WHERE cedula = ?";
        $consulta = $pdo->prepare($sql);

        // Ejecutamos la sentencia incluyendo los parámetros
        $consulta->execute(array($nombres, $nota1, $nota2, $cedula));

        // Cerramos la conexión a la base de datos
        Database::disconnect();
    }
}
