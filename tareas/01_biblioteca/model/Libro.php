<?php

class Libro{

    private $lib_codigo;
    private $lib_titulo;
    private $lib_año;
    private $lib_autor;
    private $lib_paginas;


    /**
     * Get the value of lib_codigo
     */ 
    public function getLib_codigo()
    {
        return $this->lib_codigo;
    }

    /**
     * Set the value of lib_codigo
     *
     * @return  self
     */ 
    public function setLib_codigo($lib_codigo)
    {
        $this->lib_codigo = $lib_codigo;

        return $this;
    }

    /**
     * Get the value of lib_titulo
     */ 
    public function getLib_titulo()
    {
        return $this->lib_titulo;
    }

    /**
     * Set the value of lib_titulo
     *
     * @return  self
     */ 
    public function setLib_titulo($lib_titulo)
    {
        $this->lib_titulo = $lib_titulo;

        return $this;
    }

    /**
     * Get the value of lib_año
     */ 
    public function getLib_año()
    {
        return $this->lib_año;
    }

    /**
     * Set the value of lib_año
     *
     * @return  self
     */ 
    public function setLib_año($lib_año)
    {
        $this->lib_año = $lib_año;

        return $this;
    }

    /**
     * Get the value of lib_autor
     */ 
    public function getLib_autor()
    {
        return $this->lib_autor;
    }

    /**
     * Set the value of lib_autor
     *
     * @return  self
     */ 
    public function setLib_autor($lib_autor)
    {
        $this->lib_autor = $lib_autor;

        return $this;
    }

    /**
     * Get the value of lib_paginas
     */ 
    public function getLib_paginas()
    {
        return $this->lib_paginas;
    }

    /**
     * Set the value of lib_paginas
     *
     * @return  self
     */ 
    public function setLib_paginas($lib_paginas)
    {
        $this->lib_paginas = $lib_paginas;

        return $this;
    }
}

?>