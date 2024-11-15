<?php
include 'Database.php';
include 'Nota.php';


class NotaModel
{
    public function getPromedioGeneral()
    {
        // Primero, consultamos todos los promedios de los estudiantes desde la base de datos:
        $pdo = Database::connect();
        $sql = "SELECT promedio FROM notas";  // Seleccionamos solo el campo 'promedio' de todos los estudiantes
        $resultado = $pdo->query($sql);

        $suma = 0;
        $cantidad = 0;

        // Sumamos todos los promedios:
        foreach ($resultado as $res) {
            $suma += $res['promedio'];
            $cantidad++;
        }

        Database::disconnect();

        // Calculamos el promedio general
        if ($cantidad > 0) {
            return $suma / $cantidad;  // Promedio general
        } else {
            return 0;  // En caso de que no haya estudiantes
        }
    }

    public function getNotas($orden)
    {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        //verificamos el ordenamiento asc o desc:
        if ($orden == true) //ascendente
            $sql = "SELECT * from notas order by nombres";
        else //descendente
            $sql = "SELECT * from notas order by nombres desc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Producto:

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
        //retornamos el listado resultante:
        return $listado;
    }

    public function getNota($cedula)
    {
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from notas where cedula=?";
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
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Preparamos la sentencia con parametros:
        $sql = "INSERT into notas (cedula,nombres,nota1,nota2) values(?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cedula, $nombres, $nota1, $nota2));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
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
        //Preparamos la conexión a la bdd:
        $pdo = Database::connect();
        $sql = "UPDATE notas set nombres=?,nota1=?,nota2=? where cedua¿la=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($nombres, $nota1, $nota2, $cedula));
        Database::disconnect();
    }
}
