<?php
class Nivelacademico
{
	private $pdo;
    public $id;
    public $nivel;
    public $estudio;
    public $curso_vigilancia;
    public $lugar;
    public $fecha;
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

			$stm = $this->pdo->prepare("SELECT * FROM nivel_academico WHERE usuario_id=$id");
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
			$stm = $this->pdo ->prepare("SELECT * FROM nivel_academico WHERE id = ?");		          
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
			            ->prepare("DELETE FROM nivel_academico WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
	   
		try 
		{
		  
		    $id=$data->id;
			$sql = "UPDATE nivel_academico SET nivel= ?, estudio= ?,curso_vigilancia=?, lugar=?, fecha=? WHERE id = $id";
            $this->pdo->prepare($sql)->execute(array($data->nivel, $data->estudio,$data->curso_vigilancia, $data->lugar, $data->fecha ));
		
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	

	public function Registrar(Nivelacademico $data)
	{
		try 
		{
		$sql = "INSERT INTO nivel_academico (nivel,estudio,curso_vigilancia,lugar,fecha,usuario_id) 
		        VALUES (?, ?, ?, ?,?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                        $data->nivel, 
                        $data->estudio,
                        $data->curso_vigilancia, 
                        $data->lugar,
                        $data->fecha, 
                        $data->usuario_id
                        
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	
	
	 public function Buscar($cc)
	{
		try
		{
			$result = array();
            $stm = $this->pdo->prepare("SELECT usuarios.*, usuarios.id as user ,roles.*, roles.id AS ROL_ID FROM usuarios,roles WHERE usuarios.id='$cc' AND  usuarios.rol_id=roles.id");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}