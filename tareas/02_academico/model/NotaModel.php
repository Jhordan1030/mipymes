<?php
include 'Database.php';
include 'Nota.php';


class NotaModel
{

    public function getNotas()
    {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "SELECT * from nota order by nombre";
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

    public function crearLibro($lib_codigo, $lib_titulo, $lib_año, $lib_autor, $lib_paginas)
    {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Preparamos la sentencia con parametros:
        $sql = "INSERT into libro (lib_codigo, lib_titulo, lib_año, lib_autor, lib_paginas) values(?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($lib_codigo, $lib_titulo, $lib_año, $lib_autor, $lib_paginas));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function eliminarLibro($lib_codigo)
    {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE from libro where lib_codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($lib_codigo));
        Database::disconnect();
    }

    public function actualizarlibro($lib_codigo, $lib_titulo, $lib_año, $lib_autor, $lib_paginas)
    {
        //Preparamos la conexión a la bdd:
        $pdo = Database::connect();
        $sql = "UPDATE libro set lib_titulo=?,lib_año=?,lib_auto=?, lib_paginas=? where lib_codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($lib_titulo, $lib_año, $lib_autor, $lib_paginas, $lib_codigo));
        Database::disconnect();
    }
}