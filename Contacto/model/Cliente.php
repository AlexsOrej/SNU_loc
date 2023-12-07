<?php

class Cliente
{
	private $pdo;
	
    public $id;
    public $respuesta_id;
    public $empresa_id;
    public $estado_cliente;
    public $sugerencia;
    public $created;
    public $modified;
    
    
    
    
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

			$stm = $this->pdo->prepare("SELECT * FROM contactos where empresa_id=$id");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
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
			          ->prepare("SELECT * FROM pqrs WHERE id = ?");
			          

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
			$stm = $this->pdo->prepare("DELETE FROM pqrs WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
	    
	    
	                 $id=$data->id;
	                 $nombre = $data->nombre; 
                     $apellido =  $data->apellido;
                     $identificacion = $data->identificacion;
                     $direccion =  $data->direccion;
                     $celular =  $data->celular;
                     $telefono_fijo =  $data->telefono_fijo;
                     $email =  $data->email;
                     $n_empresa =  $data->n_empresa;
                     $lugar_hecho =  $data->lugar_hecho;
                     $dirigido =  $data->dirigido;
                     $tipopqrs =  $data->tipopqrs; 
                     $f_registro =  $data->f_registro;
                     $descripcion =  $data->descripcion;
                     $f_respuesta = $data->f_respuesta; 
                     $respuesta =  $data->respuesta; 
                     $estado =  $data->estado;
                     $usuario =  $data->usuario;
	    
	    
	   
		try 
		{
			$sql = "UPDATE pqrs SET f_respuesta='$f_respuesta', respuesta='$respuesta', estado='$estado',usuario='$usuario' WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
			
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Cliente $data)
	{
	    //print_r($data);
	    //exit();
		try 
		{
		$sql = "INSERT INTO satisfacions ( respuesta_id, empresa_id,estado_cliente,sugerencia,created,modified) 
		        VALUES (?,?,?,?,?,?)";

		$this->pdo->prepare($sql)
		     ->execute( 
		        array(  $data->respuesta_id,
				        $data->empresa_id,
                        $data->estado_cliente, 
                        $data->sugerencia,
                        $data->created,
                        $data->modified
                )
			);
		   
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	

	public function Max()
	{
		try 
		{
			$stm = $this->pdo->prepare("SELECT MAX(id) as l_id  FROM pqrs ");
			          
            $stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	
	
	
	
}