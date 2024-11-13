<?php
include 'Database.php';
include 'Libro.php';

class LibroModel
{
    public function getLibros()
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM libro order by lib_titulo";
        $resultado = $pdo->query($sql);
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
        return $listado;
    }

    public function getLibro($lib_codigo)
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM libro where lib_codigo=?";
        $consulta = $pdo->prepare($sql);

        $consulta->execute(array($lib_codigo));

        $dato = $consulta->fetch(PDO::FETCH_ASSOC);

        $libro = new Libro();
        $libro -> setLib_codigo($dato['lib_codigo']);
        $libro -> setLib_titulo($dato['lib_titulo']);
        $libro -> setLib_año($dato['lib_año']);
        $libro -> setLib_autor($dato['lib_autor']);
        $libro -> setLib_paginas($dato['lib_paginas']);

        Database::disconnect();
        return $libro;
    }
}
