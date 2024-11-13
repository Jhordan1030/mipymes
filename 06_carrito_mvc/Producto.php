<?php
class  Producto{
    private $nombreProducto;
    private $cantidad;
    private $precioUnitario;
    private $subtotal;

    function __construct($nombreProducto,$precioUnitario,$cantidad)
    {
        $this->nombreProducto=$nombreProducto;
        $this->precioUnitario=$precioUnitario;
        $this->cantidad=$cantidad;
        $this->subtotal=$cantidad*$precioUnitario;
    }

    /**
     * Get the value of nombreProducto
     */ 
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * Set the value of nombreProducto
     *
     * @return  self
     */ 
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of precioUnitario
     */ 
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * Set the value of precioUnitario
     *
     * @return  self
     */ 
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }

    /**
     * Get the value of subtotal
     */ 
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the value of subtotal
     *
     * @return  self
     */ 
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }
}

?>