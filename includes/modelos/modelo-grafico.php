<?php 

	class Modelo_Grafico{
		private $conexion;
		function __construct()
		{
			require_once('../funciones/conexion.php');
			$this->conexion = $conn;
        }


		function TraerDatosGrafico(){
			$sql = " SELECT fecha, total, precio ";
            $sql .= " FROM ventas ";
            $sql .= " INNER JOIN clientes ";
            $sql .= " ON ventas.fk_idcliente = clientes.idcliente ";
            $sql .= " INNER JOIN productos ";
            $sql .= " ON ventas.fk_idproducto = productos.idproducto ";
			$arreglo = array();
			if ($consulta = $this->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->close();
			}
		}
	}
?>