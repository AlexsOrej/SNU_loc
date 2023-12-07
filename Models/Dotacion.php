<?php
class Dotacion
{
	private $pdo;
    public $id;
    public $talla_camisa;
    public $talla_pantalon;
    public $talla_zapato;
    public $usuario_id;
    
    
	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar($id)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM dotacion WHERE usuario_id ='$id' ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM dotacion WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM dotacion WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
	                    $camisa=$data->talla_camisa;
                        $pantalon=$data->talla_pantalon;
                        $zapato=$data->talla_zapato;
                        $usuario=$data->usuario_id;
                        $id=$data->id;
	    
		try 
		{
			$sql = "UPDATE dotacion SET talla_camisa= '$camisa', talla_pantalon= '$pantalon', talla_zapato='$zapato', usuario_id='$usuario' WHERE id ='$id'";

			$this->pdo->prepare($sql)->execute();
			
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Dotacion $data)
	{
	   // print_r($data);
	    //exit();
		try 
		{
		$sql = "INSERT INTO dotacion (talla_camisa,talla_pantalon,talla_zapato,usuario_id) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                        $data->talla_camisa,
                        $data->talla_pantalon,
                        $data->talla_zapato,
                        $data->usuario_id,
                        
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}