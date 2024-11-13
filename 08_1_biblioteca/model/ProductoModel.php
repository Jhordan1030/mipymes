<?php
include 'Database.php';
include 'Producto.php';


class ProductoModel
{
    /**
     *Calcula la suma total de valores de productos.
     * @return type
     */
    public function getValorProductos()
    {
        //primero consultamos todos los productos:
        $listado = $this->getProductos(true);
        //luego con un bucle obtenemos la suma:
        $suma = 0;
        foreach ($listado as $prod) {
            $suma += $prod->getPrecio() * $prod->getCantidad();
        }
        return $suma;
    }
    public function getProductos($orden)
    {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        //verificamos el ordenamiento asc o desc:
        if ($orden == true) //ascendente
            $sql = "select * from producto order by nombre";
        else //descendente
            $sql = "select * from producto order by nombre desc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos de tipo Producto:

        $listado = array();
        foreach ($resultado as $res) {
            $producto = new Producto();
            $producto->setCodigo($res['codigo']);
            $producto->setNombre($res['nombre']);
            $producto->setPrecio($res['precio']);
            $producto->setCantidad($res['cantidad']);
            array_push($listado, $producto);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    public function getProducto($codigo)
    {
        //Obtenemos la informacion del producto especifico:
        $pdo = Database::connect();
        //Utilizamos parametros para la consulta:
        $sql = "select * from producto where codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros para la consulta:
        $consulta->execute(array($codigo));
        //Extraemos el registro especifico:
        $dato = $consulta->fetch(PDO::FETCH_ASSOC);
        //Transformamos el registro obtenido a objeto:
        $producto = new Producto();
        $producto->setCodigo($dato['codigo']);
        $producto->setNombre($dato['nombre']);
        $producto->setPrecio($dato['precio']);
        $producto->setCantidad($dato['cantidad']);
        Database::disconnect();
        return $producto;
    }

    public function crearProducto($codigo, $nombre, $precio, $cantidad)
    {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Preparamos la sentencia con parametros:
        $sql = "insert into producto (codigo,nombre,precio,cantidad) values(?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try{
            $consulta->execute(array($codigo,$nombre,$precio,$cantidad));
        }catch(PDOException $e){
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    public function eliminarProducto($codigo)
    {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from producto where codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codigo));
        Database::disconnect();
    }

    public function actualizarProducto($codigo, $nombre, $precio, $cantidad)
    {
        //Preparamos la conexión a la bdd:
        $pdo = Database::connect();
        $sql = "update producto set nombre=?,precio=?,cantidad=? where codigo=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($nombre, $precio, $cantidad, $codigo));
        Database::disconnect();
    }
}
