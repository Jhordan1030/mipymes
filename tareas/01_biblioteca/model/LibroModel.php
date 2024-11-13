<?php
include 'Database.php';
include 'Libro.php';


class LibroModel
{

    public function getLibros()
    {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "SELECT * from libro order by lib_titulo";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Producto:
        $listado = array();
        foreach ($resultado as $res) {
            $libro = new Libro();
            $libro->setLib_codigo($res['lib_codigo']);
            $libro->setLib_titulo($res['lib_titulo']);
            $libro->setLib_año($res['lib_año']);
            $libro->setLib_autor($res['lib_autor']);
            $libro->setLib_paginas($res['lib_paginas']);
            array_push($listado, $libro);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }


    public function getLibro($lib_codigo)
    {
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "SELECT * from libro where lib_codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($lib_codigo));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $libro = new Libro();
        $libro->setLib_codigo($dato['lib_codigo']);
        $libro->setLib_titulo($dato['lib_titulo']);
        $libro->setLib_año($dato['Lib_año']);
        $libro->setLib_autor($dato['lib_autor']);
        $libro->setLib_paginas($dato['lib_paginas']);
        Database::disconnect();
        return $libro;
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