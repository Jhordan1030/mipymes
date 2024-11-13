<?php
class Libro {
    private $lib_codigo;
    private $lib_titulo;
    private $lib_año;
    private $lib_autor;
    private $lib_paginas;

    public function __construct($lib_codigo = null, $lib_titulo = null, $lib_año = null, $lib_autor = null, $lib_paginas = null) {
        $this->lib_codigo = $lib_codigo;
        $this->lib_titulo = $lib_titulo;
        $this->lib_año = $lib_año;
        $this->lib_autor = $lib_autor;
        $this->lib_paginas = $lib_paginas;
    }

    public function getLibCodigo() {
        return $this->lib_codigo;
    }

    public function setLibCodigo($lib_codigo) {
        $this->lib_codigo = $lib_codigo;
    }

    public function getLibTitulo() {
        return $this->lib_titulo;
    }

    public function setLibTitulo($lib_titulo) {
        $this->lib_titulo = $lib_titulo;
    }

    public function getLibAño() {
        return $this->lib_año;
    }

    public function setLibAño($lib_año) {
        $this->lib_año = $lib_año;
    }

    public function getLibAutor() {
        return $this->lib_autor;
    }

    public function setLibAutor($lib_autor) {
        $this->lib_autor = $lib_autor;
    }

    public function getLibPaginas() {
        return $this->lib_paginas;
    }

    public function setLibPaginas($lib_paginas) {
        $this->lib_paginas = $lib_paginas;
    }
}
?>
