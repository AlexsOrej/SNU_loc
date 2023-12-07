<?php

class Requisicion
{
    private $pdo;
    public $id;
    public $cargo_requerido;
    public $num_vacantes;
    public $sede;
    public $proceso;
    public $motivo;
    public $prioridad;
    public $fecha_ingreso;
    public $solicitante;
    public $aprobado_por;
    public $cantidad;
    public $supervisor;
    public $ingreso;
    public $remplaza;
    public $razonsocial;
    public $nombre;
    public $registro;

    public function __CONSTRUCT()
    {
        try
        {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("SELECT clientes.razonsocial as cliente, requisicions.*, cargos.nombre as cargo, obras.nombre as obra, codigo_obra
            FROM requisicions, cargos, clientes, obras 
            WHERE
            requisicions.cargo_solicitado=cargos.id
            AND
            requisicions.cliente_id=clientes.id
            AND
            requisicions.obra_id=obras.id
            ");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try
        {
            $stm = $this->pdo
                ->prepare("SELECT * FROM requisicions WHERE id = ?");

            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try
        {
            $stm = $this->pdo->prepare("DELETE FROM requisicions WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {

        $nombre = $data->nombre;
        $registro = $data->registro;
        $id = $data->id;
        // exit();
        try
        {
            $sql = "UPDATE requisicions SET nom_solicitud= '$data->nom_solicitud',cargo_solicitud= '$data->cargo_solicitud', f_solicitud= '$data->f_solicitud',
											cliente_id= '$data->cliente_id',centro_costo= '$data->centro_costo', zona= '$data->zona',
											ciudad= '$data->ciudad',cargo_solicitado= '$data->cargo_solicitado',cantidad= '$data->cantidad',
											supervisor= '$data->supervisor',ingreso= '$data->ingreso',obra_id= '$data->obra_id'
										WHERE id = $id";

            $this->pdo->prepare($sql)->execute();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Requisicion $data)
    {
        // print_r($data);
        //exit();
        try
        {
            $sql = "INSERT INTO requisicions (nom_solicitud,cargo_solicitud, f_solicitud, cliente_id, centro_costo, zona, ciudad, cargo_solicitado, cantidad, supervisor, ingreso, obra_id, estado)
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->nom_solicitud,
                        $data->cargo_solicitud,
                        $data->f_solicitud,
                        $data->cliente_id,
                        $data->centro_costo,
                        $data->zona,
                        $data->ciudad,
                        $data->cargo_solicitado,
                        $data->cantidad,
                        $data->supervisor,
                        $data->ingreso,
                        $data->obra_id,
                        $data->estado,
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Usuario_cargo($id)
    {

        try
        {
            $stm = $this->pdo->prepare("SELECT MAX(usuario_cargo.id) as id_cargo , cargos.*
                       FROM usuario_cargo, cargos
                       WHERE usuario_cargo.usuario_id = ?
                       AND  usuario_cargo.cargo_id=cargos.id");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function Clientes()
    {

        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM clientes");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
    public function Obras($id)
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM obras WHERE  cliente_id= ? ");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
   
   public function Obrasup($id)
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM obras WHERE  id= ? ");
            $stm->execute(array($id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
   
   
    public function Cargos()
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM cargos ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }


    public function Autor_guardar($data)
    {   $id = $data->id;
        $id_cargo = $data->cargo_id;
        try
        {
            $sql = "UPDATE requisicions SET estado= '$data->estado' WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        
            if($data->estado=="Aceptado"){
                $estado='Vacante';
            }else{
                $estado='Cerrado';
            }

            $sql1 = "UPDATE cargos SET estado= '$estado' WHERE id = $id_cargo";
            $this->pdo->prepare($sql1)->execute();

        } catch (Exception $e) {
            die($e->getMessage());
        }



    }
    
    public function Ver($id){
        
        try{
            
            $stm =$this->pdo->prepare("SELECT requisicion_contrato.id, usuario_cargo.id,inicio_contrato, usuarios.Nombre,Apellido,cedula , requisicions.f_solicitud
                                           FROM requisicion_contrato, usuario_cargo, usuarios, requisicions
                                              WHERE
                                                   requisicion_contrato.requis_id=$id
                                                AND
                                                   requisicion_contrato.contr_id=usuario_cargo.id
                                                AND
                                                   requisicion_contrato.requis_id=requisicions.id
                                                AND
                                                   usuario_cargo.usuario_id = usuarios.id
                                              ");
                                              
            $stm->execute(array($id));
            return $stm->fetch();                                         
            
        }catch(Excetion $e){
            die($e->getMessage());
        }
        
        
    }
    
    
    
    

}