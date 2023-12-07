<?php

class Requisicion
{
    public $id;
    public $cargo_requerido;
    public $num_vacantes;
    public $sede;
    public $cargo_id;   
    public $motivo;
    public $prioridad;
    public $fecha_ingreso;
    public $solicitante;
    public $aprobado_por;
    public $fecha_eval_comp;
    public $resultado;
    public $tiempo_dur_vac;
    public $condiciones;
    public $fecha_req;
    public $estado;
    
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
            $stm = $this->pdo->prepare("SELECT  requisicions.*, cargos.cargo as cargo
            FROM requisicions, cargos 
            WHERE
            requisicions.cargo_id=cargos.id            
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
            $stm = $this->pdo->prepare("SELECT * FROM requisicions WHERE id = ?");
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

        try
        {
            $condicion = filter_var($data->condiciones, FILTER_SANITIZE_SPECIAL_CHARS); 
            $sql = "UPDATE requisicions SET cargo_id='$data->cargo_requerido',num_vacantes='$data->num_vacantes', sede='$data->sede',
            motivo='$data->motivo', prioridad='$data->prioridad', fecha_ingreso='$data->fecha_ingreso', 
            condiciones='$condicion', estado='$data->estado'
			WHERE id = $data->id";
            $result =  $this->pdo->prepare($sql)->execute();
            if($result){
                echo "Requisicion modificada con exito";
            }else{
                echo "Hubo un error";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Requisicion $data)
    {
         //print_r($data);
        // exit();
        try
        {
            $sql = "INSERT INTO requisicions(cargo_id,num_vacantes, sede,
            motivo, prioridad, fecha_ingreso,
            solicitante, aprobado_por, fecha_eval_comp, resultado, 
            tiempo_dur_vac, condiciones, estado,fecha_req)
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
            $result = $this->pdo->prepare($sql)->execute(array(
                        $data->cargo_requerido,
                        $data->num_vacantes,
                        $data->sede,
                        $data->motivo,
                        $data->prioridad,
                        $data->fecha_ingreso,
                        $data->nom_solicitud,
                        $data->aprobado_por,
                        '0000-00-00',
                        $data->resultado,
                        $data->tiempo_dur_vac,
                        $data->condiciones,
                        $data->estado,
                        $data->f_solicitud,
                    )
                );

                if($result){
                    echo "Requisicion registrada con exito";
                }else{
                    echo "Hubo un error";
                }

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
   
    public function sedes(){
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM sedes ");
            $stm->execute();
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
            $sql = "UPDATE requisicions SET estado= $data->estado WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        
            // if($data->estado=="Aceptado"){
            //     $estado='Vacante';
            // }else{
            //     $estado='Cerrado';
            // }

            // $sql1 = "UPDATE cargos SET estado= '$estado' WHERE id = $id_cargo";
            // $this->pdo->prepare($sql1)->execute();

        } catch (Exception $e) {
            die($e->getMessage());
        }



    }
    public function Eval_guardar($data)
    {   
        try
        {
            $sql = "UPDATE requisicions SET aprobado_por='$data->aprobado_por' ,
            fecha_eval_comp='$data->fecha_eval_comp',
            resultado='$data->resultado',
            tiempo_dur_vac='$data->tiempo_dur_vac' 
            WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();        

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