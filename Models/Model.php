<?php

class Model
{

    private $pdo;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    function CreateTable($tableName)
    {
    }
    public function ModelSociodemografico()
    {
        $model = array(
            'id', 'nombre', 'apellidos', 'correo', 'telefono_fijo', 'celular',
            'rol_id', 'Sexo', 'cedula', 'expedicion', 'rh', 'LugarNacimiento',
            'FechaNacimiento', 'direccion', 'Barrio', 'FechaRegistro',
            'estado', 'estado_civil', 'nom_contacto_emergencia', 'num_contacto_emergencia',
            'edad_pension', 'tiempo_pension', 'ciudad_recidencia', 'estrato',
            'cargo_jefe_id', 'nivel_educativo', 'profesion', 'uec', 'fec', 'ued', 'fed'
        );

        // $sql2 = "CALL `p1`()";
        $sql2 = "describe personal";
        $stmt = $this->pdo->prepare($sql2);
        $stmt->execute();
        while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
            $current_columns[] = $fields->Field;
        }
        foreach ($model as $models) {
            // Compare existing columns to desired state, and create if necessary   
            if (!in_array($models, $current_columns)) {
                $campo = "ALTER TABLE `personal` ADD $models VARCHAR(50) NOT NULL ";
                $stmt = $this->pdo->prepare($campo);
                $stmt->execute();
            }
        }
    }
    public function ModelSolicitud()
    {
        $model = array(
            'id', 'NombreSolicitante', 'FechaSolicitud', 'Proceso', 'TipoSolicitud', 'Codigo', 'VersionCambiar',
            'TipoDocumento',  'Descripcion',    'EjecucionCambio',    'Aprobado',    'Observaciones',    'filename',    'dir'
        );
        $tbl_solicitud = "describe solicitudes";
        $stmt = $this->pdo->prepare($tbl_solicitud);
        $stmt->execute();
        while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
            $current_columns[] = $fields->Field;
        }
        $filename =  "ALTER TABLE solicitudes 
                                                    MODIFY filename VARCHAR(255) NULL,
                                                    MODIFY dir VARCHAR(255) NULL";
        $stmt = $this->pdo->prepare($filename);
        $stmt->execute();
    }

    public function ModelgestionSolicitud($tableName)
    {

        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'usuario_id', 'proceso_id', 'actividad'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(100)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `gestion_solicitudes` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usuario_id` int(11) NOT NULL,
                    `proceso_id` int(11) NOT NULL,
                    `actividad` varchar(255) NOT NULL,                    
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                throw new PDOException("Error en la consulta: " . $error[2]);
            }
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    }

    public function ModelDocOnline($tableName)
    {
        try {
            $this->pdo->prepare("SELECT 1 FROM $tableName LIMIT 1");
            // echo "La tabla $tableName ya existe.";
            //  --------------------------------
            $model = array('id', 'solicitud_id', 'contenido', 'fecha_creacion', 'estado', 'editor');
            $tbl_doc_online = "describe doc_online";
            $stmt = $this->pdo->prepare($tbl_doc_online);
            $stmt->execute();
            while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                $current_columns[] = $fields->Field;
            }
            foreach ($model as $models) {
                // Compare existing columns to desired state, and create if necessary   
                if (!in_array($models, $current_columns)) {
                    $campo = "ALTER TABLE `doc_online` ADD $models VARCHAR(50)  NULL";
                    $stmt = $this->pdo->prepare($campo);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            // Crear la tabla si no existe
            $sql = "CREATE TABLE $tableName (
                id INT AUTO_INCREMENT PRIMARY KEY,
                solicitud_id INT(11),
                contenido  LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
                fecha_creacion date,
                estado INT(11),
                editor VARCHAR(25) )";
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                echo "Tabla $tableName creada exitosamente.";
            } catch (Exception $e) {
                echo "Error creando la tabla $tableName: " . $e->getMessage();
            }
        }
        $tbl = "SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY' ";
        $stmt = $this->pdo->prepare($tbl);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $id =  "ALTER TABLE doc_online        
        MODIFY COLUMN id INT AUTO_INCREMENT PRIMARY KEY";
        } else {
            $id =  "ALTER TABLE doc_online
            DROP PRIMARY KEY,
            MODIFY COLUMN id INT AUTO_INCREMENT PRIMARY KEY";
        }
        $stmt = $this->pdo->prepare($id);
        $stmt->execute();
    }

    public function TblSociodemografico($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array('id', 'personal_id', 'dependientes', 'cuantas_personas_vive', 'alergias', 'cual_alergia', 'medio_transporte', 'tiempo_desplazamiento', 'uso_tiempo_libre', 'otros_trabajos', 'funciones', 'fuma', 'licor', 'realiza_ejercicio', 'fecha_registro');


            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe sociodemografico";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                $sql = "CREATE TABLE $tableName (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            personal_id int(11) NOT NULL,
            dependientes int(11) NOT NULL,
            cuantas_personas_vive int(11) NOT NULL,
            alergias VARCHAR(255) NOT NULL,
            cual_alergia VARCHAR(255) NOT NULL,
            medio_transporte VARCHAR(255) NOT NULL,
            uso_tiempo_libre VARCHAR(255) NOT NULL,
            otros_trabajos VARCHAR(255) NOT NULL,
            fuma VARCHAR(255) NOT NULL,
            licor VARCHAR(255) NOT NULL,
            realiza_ejercicio VARCHAR(255) NOT NULL,
            fecha_registro date)";
                $this->pdo->exec($sql);
            }
        } catch (Exception $e) {
        }
    }
    public function TblAusentismo($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'personal_id',  'tipo_ausencia_id', 'cie10', 'diagnostico', 'organo_sistema',
                'dias_calendario_ausente', 'horas_ausente_real',
                'incap_genarada_por', 'nom_ips',  'nom_profesional', 'observaciones',  'soporte_original', 'f_inicio', 'f_fin'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {

                echo 'NO EXISTE LA TBL';
                $sql = "CREATE TABLE $tableName (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            personal_id int(11) NOT NULL,
            tipo_ausencia_id int(11) NOT NULL,
            cie10 int(11) NOT NULL,
            diagnostico VARCHAR(255) NOT NULL,
            organo_sistema VARCHAR(255) NOT NULL,            
            dias_calendario_ausente VARCHAR(30) NOT NULL,
            horas_ausente_real int(11) NOT NULL,
            incap_genarada_por varchar(255) NOT NULL,
            nom_ips varchar(255)  NULL,
            nom_profesional varchar(255)  NULL,
            observaciones varchar(255)  NULL,
            soporte_original varchar(255)  NULL,
            f_inicio date  NULL,
            f_fin date  NULL
            )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblaccionusuario($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'accion_id', 'usuario_id', 'estado'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE $tableName (
                  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  accion_id int(11) NOT NULL,
                  usuario_id int(11) NOT NULL
                  )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblusuariosprocesos($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'proceso_id', 'usuario_id'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE $tableName (
                  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  proceso_id int(11) NOT NULL,
                  usuario_id int(11) NOT NULL
                  )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblPersonal($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'nombre', 'apellidos', 'correo', 'telefono_fijo', 'celular',
                'rol_id', 'Sexo', 'cedula', 'expedicion', 'rh',
                'LugarNacimiento', 'FechaNacimiento', 'direccion', 'Barrio', 'FechaRegistro',
                'estado', 'estado_civil', 'nom_contacto_emergencia', 'num_contacto_emergencia', 'edad_pension', 'tiempo_pension', 'ciudad_recidencia',
                'estrato', 'cargo_jefe_id', 'nivel_educativo',
                'profesion', 'uec',    'fec', 'ued', 'fed'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `personal` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `telefono_fijo` varchar(20) DEFAULT NULL,
                    `celular` bigint(20) DEFAULT NULL,
                    `rol_id` int(11) NOT NULL,
                    `Sexo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `cedula` bigint(20) NOT NULL,
                    `expedicion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `rh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `LugarNacimiento` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `FechaNacimiento` date NOT NULL,
                    `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                    `Barrio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                    `FechaRegistro` date NOT NULL,
                    `estado` varchar(11) DEFAULT NULL COMMENT '1=activo, 0=inactivo',
                    `estado_civil` varchar(255) DEFAULT NULL COMMENT 'a) soltero b) casado por lo civil c) divorciado legalmente d) separado legalmente e) viudo de matrimonio civil',
                    `nom_contacto_emergencia` varchar(255) DEFAULT NULL,
                    `num_contacto_emergencia` bigint(20) DEFAULT NULL,
                    `edad_pension` varchar(255) DEFAULT NULL,
                    `tiempo_pension` varchar(255) DEFAULT NULL,
                    `ciudad_recidencia` varchar(255) DEFAULT NULL,
                    `estrato` int(11) DEFAULT NULL,
                    `cargo_jefe_id` int(11) DEFAULT NULL,
                    `nivel_educativo` varchar(255) DEFAULT NULL,
                    `profesion` varchar(255) DEFAULT NULL,
                    `uec` varchar(255) DEFAULT NULL COMMENT 'Ultima evaluación de competecias',
                    `fec` date DEFAULT NULL COMMENT 'fecha evaluación de competecias',
                    `ued` varchar(255) DEFAULT NULL COMMENT 'Ultima evaluación de desempeño',
                    `fed` date DEFAULT NULL COMMENT 'fecha evaluación de desempeño',
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `cedula` (`cedula`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tbltiponovedades($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'evento', 'tipo'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `tipo_novedades` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `evento` varchar(255) NOT NULL,
                    `tipo` int(11) NOT NULL COMMENT '1=novedades, 2=ausentismo',
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblnovedad($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'persona_id', 'tipo_id', 'descripcion', 'fecha_novedad', 'fecha_registro', 'soporte'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `novedades` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `persona_id` int(11) NOT NULL,
                    `tipo_id` int(11) NOT NULL,
                    `descripcion` varchar(6500) DEFAULT NULL,
                    `fecha_novedad` date NOT NULL,
                    `fecha_registro` date NOT NULL,
                    `soporte` varchar(255) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblstado($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'status'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `stados` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `status` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();

                $datos = "INSERT INTO status (id, status) VALUES
                (1, 'Aspirante'),
                (2, 'Seleccionado'),
                (3, 'Contratado'),
                (4, 'Rechazado')";
                $stmt = $this->pdo->prepare($datos);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblrequisicions($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'cargo_id', 'num_vacantes',
                'sede', 'motivo', 'prioridad',
                'fecha_ingreso', 'solicitante',
                'aprobado_por', 'fecha_eval_comp',
                'resultado', 'tiempo_dur_vac',
                'condiciones', 'estado', 'fecha_req'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `requisicions` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `cargo_id` varchar(255) NOT NULL,
                    `num_vacantes` varchar(255) NOT NULL,
                    `sede` varchar(11) NOT NULL,
                    `motivo` varchar(15) NOT NULL,
                    `prioridad` varchar(255) NOT NULL,
                    `fecha_ingreso` varchar(255) NOT NULL,
                    `solicitante` varchar(255) NOT NULL,
                    `aprobado_por` varchar(55) DEFAULT NULL,
                    `fecha_eval_comp` date DEFAULT NULL,
                    `resultado` varchar(255) DEFAULT NULL,
                    `tiempo_dur_vac` varchar(255) DEFAULT NULL,
                    `condiciones` varchar(1500) NOT NULL,
                    `estado` int(11) NOT NULL COMMENT '1=solicitado, 2=aprobado 3=rechazado',
                    `fecha_req` date NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblpostulaciones($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'usuario_id', 'cargo_id', 'aplicacion'

            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `postulaciones` (
                    `id` int(11) NOT NULL,
                    `usuario_id` bigint(11) NOT NULL,
                    `cargo_id` int(11) NOT NULL,
                    `aplicacion` date NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `usuario_id` (`usuario_id`)
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tblpersonacontratos($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',                'persona_id',
                'cargo_id',                'duracion',
                'tipo_contrato',                'inicio_contrato',
                'valor',                'aux_trans',
                'registro',                'usuario',
                'lugar',                'manual',                'contrato'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `persona_contratos` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `persona_id` varchar(255) NOT NULL,
                    `cargo_id` int(11) NOT NULL,
                    `duracion` varchar(5000) NOT NULL,
                    `tipo_contrato` varchar(255) NOT NULL,
                    `inicio_contrato` date NOT NULL,
                    `valor` int(11) NOT NULL,
                    `aux_trans` int(11) NOT NULL,
                    `registro` date NOT NULL,
                    `usuario` varchar(255) NOT NULL,
                    `lugar` varchar(255) NOT NULL,
                    `manual` varchar(3) NOT NULL,
                    `contrato` varchar(3) NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblTipoContratos($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'nombre', 'contenido'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `tipo_contratos` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                    `contenido` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblContratoFirma($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'contrato_id', 'imgfirma', 'registro'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `contrato_firmas` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `contrato_id` int(11) NOT NULL,
                    `imgfirma` varchar(255) NOT NULL,
                    `registro` date NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblProveedor($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id', 'tipo_servicio', 'nombre_proveedor',
                'direccion', 'ciudad', 'telefono', 'email',
                'contacto', 'estado', 'pais, nit'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE proveedores (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    tipo_servicio VARCHAR(50) NOT NULL,
                    nombre VARCHAR(50) NOT NULL,
                    direccion VARCHAR(100) NOT NULL,
                    ciudad VARCHAR(50) NOT NULL,
                    telefono VARCHAR(20),
                    email VARCHAR(50),
                    contacto VARCHAR(50),                    
                    estado VARCHAR(20),
                    pais VARCHAR(50),
                    nit VARCHAR(50)
                   )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblAfiliacion($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'usuario_id',
                'eps',
                'arl',
                'fondo',
                'afiliacion_fecha',
                'caja'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `afiliaciones` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usuario_id` int(11) NOT NULL,
                    `eps` varchar(255) NOT NULL,
                    `arl` varchar(255) NOT NULL,
                    `fondo` varchar(255) NOT NULL,
                    `afiliacion_fecha` date NOT NULL,
                    `caja` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblGrupofamiliar($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'nombre',
                'apellidos',
                'parentesco',
                'contacto',
                'fecha_nacimiento',
                'usuario_id'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `grupofamiliar` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(255) NOT NULL,
                    `apellidos` varchar(255) NOT NULL,
                    `parentesco` varchar(255) NOT NULL,
                    `contacto` bigint(20) NOT NULL,
                    `fecha_nacimiento` date NOT NULL,
                    `usuario_id` int(11) NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `usuario_id` (`usuario_id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }

    public function TblInsumos($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'nombre',
                'ref_presentacion',
                'unidad',
                'costounitario',
                'total',
                'proveedor_id',
                'f_ingreso',
                'f_caducidad',
                'estado',
                'c_barras',
                'ubicacion',
                'stock_min',
                'stock_max',
                'tiempo_entrega',
                'ultimo_pedido',
                'cantidad'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `insumos` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
                    `nombre` varchar(255) NOT NULL,
                    `ref_presentacion` varchar(255)  NULL,
                    `unidad` varchar(255)  NULL,
                    `costounitario` varchar(255) NULL,
                    `total` date  NULL,
                    `proveedor_id` int(11)  NULL,
                    `f_ingreso` DATE,
                    `f_caducidad` DATE,
                    `estado` varchar(20),
                    `c_barras` VARCHAR(50),
                    `ubicacion` VARCHAR(50),
                    `stock_min` INT,
                    `stock_max` INT,
                    `tiempo_entrega` varchar(50),
                    `ultimo_pedido` DATE,
                    `cantidad` varchar(255) NULL
                )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }
            $val = "SELECT COUNT(*) FROM insumos";
            $stmt = $this->pdo->prepare($val);
            $stmt->execute();
            $result = $stmt->fetchColumn();

            if ($result == 0) {
                try {
                    $sql = "ALTER TABLE `insumos`
                        CHANGE `costounitario` `costounitario` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
                        CHANGE `total` `total` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
                        CHANGE `cantidad` `cantidad` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute();
                    $insumos = "INSERT INTO `insumos` (`nombre`, `ref_presentacion`, `unidad`, `costounitario`, `total`, `proveedor_id`, `f_ingreso`, `f_caducidad`, `estado`, `c_barras`, `ubicacion`, `stock_min`, `stock_max`, `tiempo_entrega`, `ultimo_pedido`, `cantidad`) VALUES
                ( 'ACIDO MURIATICO GALON X 3800 CC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ACRILICOS 80ML 1 DE CADA UNO AMARILLO- AZUL- ROJO- BLANCO- NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'AEROGRAFO SET CON MANGUERA DE 3 MTS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'AMBIENTADOR EN AEROSOL BRIZZE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'AMBIENTADOR LIQUIDO GALON X 3750 CC ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ARCILLAÂ Â  X KILO ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'AROMATICA JAIBEL/TIZANA ECO CAJA TRADICIONAL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ATOMIZADORES DE AGUA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'AZUCAR X 200 SOBRES RIOPAILA/ TUBO STICK', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BANDAS DE CAUCHO X CAJA CAUCHOQUIM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BANDAS LIGAS DE CAUCHO X KILO VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BANDERITAS POST IT 683-4 1/2 COLORES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BASTIDOR CON TELA PARA CUADROS 20X25', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BAYETILLA POR METRO BLANCA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BAYETILLA POR METRO ROJA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BISTURI GRANDE ECONOMICO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BLOCK ANOTACIONES CANARIO 1/2 CARTA CUADROS WINGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('BLOCK ANOTACIONES CANARIO CARTA CUADROS WINGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BLOCK HOJA BLANCA TAMANO CARTA  ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BLOCK PAPEL EDAD MEDIA 1/8 X 20 HOJAS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BLOCK PAPEL IRIS COLORES T.CARTA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BLOCK PAPEL IRIS COLORES T.OFICIO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO BIC CRISTAL AZUL BIC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO BIC CRISTAL NEGRO BIC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO BIC CRISTAL ROJO BIC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO SOFT GEL PELIKAN AZUL PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO SOFT GEL PELIKAN NEGRO PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLIGRAFO SOFT GEL PELIKAN ROJO PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLSA PARA BASURA 55 X 55 PAQ *6 BLANCA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLSA PLASTICA 70*100 NEGRA UNIDAD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLSA PLASTICA 70*100 VERDE UNIDAD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOLSAS ZIPLOC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BORRADOR DE NATA PELIKAN PZ-20', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BORRADOR PARA TABLERO ACRILICO K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOTELLA ALCOHOL ANTISEPTICO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BOTELLON DE AGUA C/ENVASE NUEVO Y PUSH ECO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BROCHAS EN CERDE #3CM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BROCHAS EN CERDE #6CM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'BROCHAS EN CERDE #8CM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CAFE SELLO ROJO X LIBRA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CAJA DE ARCHIVO INACTIVO X 200 C620K', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CAJAS DE ESFEROS RETRACTIL X 12 UNIDADES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CALCULADORA 12 DIGITOS TRULY 837-12 DE MESA TRULLY', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARPETA DE PRESENTACION KIMBERLY T.CARTA K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARPETA DE ROTULOS LASER P/CD REF: 3150', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARPETA DE SOLAPA DE 4 ALETAS EN PROPALCOTE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARPETA PLASTIFOLDER T.CARTA K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARPETA SEGURIDAD OFFIESCO TIPO SOBRE T.OFICIO OFFIESCO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARRETES DE HILO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTELERA EN CORCHO 60 X 80 CMS K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTON PAJA EN PLIEGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHO DE TINTA EPSON T135120AL T25/TX125 135N', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9370A- TINTA PHOTO BLACK PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9371A- TINTA CYAN PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9372A- TINTA MAGENT PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9373A TINTA YELLOW PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9374A- TINTA GRAY PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTUCHOS HP NO. 72- REFERENCIA C9403A- TINTA MATTE BLACK PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTULINA BLANCA CARTA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTULINA BLANCA OFICIO.', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CARTULINA BRISTOL EN COLORES 10/8', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CEPILLO DE MANO TIPO PLANCHA ARCO ASEO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CERA LIQUIDA AUTOBRILANTE *1000CC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CHINCHE GEMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CHURRUSCO VERTICAL GRANDE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA ENMASCARAR 12MM X 40MTS TESA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA ENMASCARAR 48MM * 40MTS MATIX', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA MAGICA 12MM X 33MTS SCOTCH 3M', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA P/EMPAQUE TRANSPARENTE 48*100 R 301 3M', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA PARA IMPRESORA EPSON 8750 LX 810/300 EPSON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA PARA IMPRESORA EPSON 8755 FX 1050/1170 EPSON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CINTA TRANSPARENTE 12*40 ZS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CLIP GEMA # 1 GEMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CLIP JUMBO TRITON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CLIP MARIPOSA TRITON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COLBON PARA PAPEL X 245 GRS BASF', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COLORES MAGICOLORÂ  6/12', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COMPRESOR D500SR 1/8', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CORTADOR ALMA METALICA CUERPO PLASTICO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COSEDORA GENMES 5527 PEQUEÃ‘A GENMES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COSEDORA RANK 570', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'COSEDORA SEMI IND 100 HJS REF:50SF GENMES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CREMA LAVALOZA *1000 GR FULL FRESSH', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CUADERNO ESPIRAL 85 CUADRICULADO **EXENTO**', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'CUADERNOS COSIDOS X 100 HOJAS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DESENGRASANTE 3000 C.C ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DIPLOMA HOJA LISA PAPEL KIMBERLI 180 GR BCO ART * 10 HJS CARTA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO CD-R TORRE X 25 IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO CD-RW TORRE X 25 IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO CD-R IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO CD-RW IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO DVD/RW IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO DVD+RW TORRE X 25 IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO DVD-R IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISCO COMPACTO DVD-R TORRE X 25 IMATION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'DISPENSADOR CINTA PARA ESCRITORIO PEQUEÃ‘O', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ECOLIN 30ML 6X COLOR BLANCO- ROJO- AMARILLO- AZUL- NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ESCARAPELA VERTICAL CON CORDON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ESCOBA DURA FULLER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ESCOBA SUAVE FULLER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ESPONJILLA SABRA UNIDAD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ESTUCHE PARA CD VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FICHAS BIBLIOGRAFICAS PAQUETES (DIFERENTES COLORES)', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FILTRO PARA GRECA NO 4', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FILTRO PARA GRECA NO 8', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FOLDER CELUGUIA HORIZONTAL CARTA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FOLDER CELUGUIA HORIZONTAL OFICIO NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FORMA - 20-02 RECIBO CAJA MENOR * 100', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('FOTOCOPIADORA CANON 1025J GPR 22', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GALON DE BLANQUEADOR X 3750 CC ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO COSEDORA 26/06 WINGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO LEGAJADOR POLIP.TRANSP. PQT*20 RANK', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 1 1/4 CAJA X 12 VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 1 1/4 VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 1 5/8 CAJA X 12', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 1/2 X12 VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 2 CAJA X 12 VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO TIPO LOTERO 3/4 *12 VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GANCHO WINGO COSEDORA 23/14 WINGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GEL BACTISAN SCOTT SPRAY 400ML 30197085', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('GLOBOS R12 ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'GUANTES INDUSTRIAL CALIBRE 25 TALLA 8', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'GUANTES INDUSTRIAL CALIBRE 25 TALLA 9', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'GUIA CLASIFICADORA 105 PLASTICA CAL 18 IPP', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'HUMEDECEDOR DE DEDOS SORTKWIK 50 GMS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'INSTACREM SOBRES *100 INSTACREM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON DE MANOS ANTIBACTERIAL 3.785 CC ECONOMICO - ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON DETERGENTE FAB X 900 GRAMOS FAB', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON EN BARRA REY DERSA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON EN POLVO 1A AJAX 500 CC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON ESPUMA KLEENEX * 800 C.C 30197006', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'JABON MULTIUSOS LIQUIDO MAVAL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LACAS DE COLORES 300ML 5 DE CADA UNO AMARILLO- AZUL-ROJO-BLANCO- NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LAPICES 6B', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LAPICES X 24 JUMBO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LAPIZ BEROL MIRADO # 2 BEROL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LAPIZ CORRECTOR FABER CASTEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LEGAJADOR A-Z CARTA NORMA ECONOMICO AZUL NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LEGAJADOR A-Z OFICIO NORMA ECONOMICO AZUL NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIMPIA COMPUTADOR - DESMANCHADOR POTENTE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIMPIADOR DESINFECTANTE MAVAL GALON 3800 CC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIMPIADOR P/PORTATIL Y PANTALLA LCD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIMPIAVIDRIOS X GALON 3750 CC ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIMPION TIPO TELA BLANCO COCINA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LIQUIDO CUBRERASGUÃ‘OS PARA MADERA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'LUSTRAMUEBLES X 200 CC PERLA/ FULLER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR PERMANENTE AZUL BEROL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR PERMANENTE NEGRO BEROL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR PERMANENTE ROJO BEROL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR PERSONALITY WINGO NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR PERTENECE A VERDE BEROL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SECO BEROL AZUL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SECO BEROL NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SECO BEROL ROJO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SECO BEROL VERDE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SHARPIE DOBLE PUNTA TWIN - AZUL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SHARPIE DOBLE PUNTA TWIN - NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MARCADOR SHARPIE DOBLE PUNTA TWIN - ROJO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MECHA PARA TRAPERO X 500 GR', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MEMORIA USB 16GB KINGSTON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MEMORIA USB 8GB KINGSTON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'MEZCLADORES X 1000', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'OLEOS CAJA DE 12X12ML', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'OPALINA 225 GRS T. CARTA RESMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'ORGANIZADOR DOCUMENTOS PAQ.X6 BEBA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'PAD MAUSE ERGONOMICOS CON GEL ARTECMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'PALETAS REDONDAS PLASTICAS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ( 'PAÃ‘O ABSORBENTE ETERNA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL FOTOCOPIA T.CARTA 75 GRS REPROGRAF', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL FOTOCOPIA T.OFICIO 75 GRS REPROGRAF', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL HIGIENICO BLANCO JUMBO PAQ * 4 X 250 MTS SCOTT REF: 30200242', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL IRIS PLIEGO 70*100', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL PARA DIPLOMAS OPALINA 180GRS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL PERIODICO PLIEGO 70 X 100 ***EXENTO**', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPEL SEDA 1/2 PLIEGO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAPELERA PARA PISO MALLA K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAQ. X 160 GUIAS P/FOLDER CELUGUIA BLANCO DI-MATIC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAQUETE DE GUIA CLASIFICADORA 105-12 ECONOMICA MYM', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PAQUETE X 100 REFUERZOS PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PASTA 105 CATALOGO 0.5 R SITAEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PASTA 105 CATALOGO 1.0 R SITAEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PASTA 105 CATALOGO 1.5 R MASTER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PASTA 105 CATALOGO 3.0 R SITAEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PEGANTE EN BARRA 40 GR KORES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PEGANTE EN BARRA X 20 GRS KORES/ SIPEGA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PERFORADORA 2 HUE. 100 HJS KW-9380', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PERFORADORA GENMES REF: 91FO 2 HUECOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PILA AA ENERGIZER BLISTER X 2 ENERGIZER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PILA AAA ENERGIZER BLISTER X 2 ENERGIZER', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PILA EVEREADY 9V CUADRADA EVEREADY', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PINCEL LION SINTETICO PLANO #3', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PINCELES NO 10', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLANILLERA-ACRILICA COLORES T.OFICIO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLASTILINA KILO VARIOS COLORES AMARILLO- AZUL- ROJO- NEGRO- BLANCO- PIEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLASTILINAÂ  X 10 COLORES SURTIDA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLIEGOS CARTON CARTULINA CALIBRE 16 ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLIEGOS DE PAPEL KRAF', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMIGRAFO PELIKAN MICROPUNTA AZUL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMIGRAFO PELIKAN MICROPUNTA NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMIGRAFO PELIKAN MICROPUNTA ROJO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMIGRAFO PELIKAN MICROPUNTA VERDE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMILLAS CON PORTAÂ  - Â SET CON 6 PUNTAS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PLUMILLAS NORMAL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PORTA REVISTAS NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PORTABORRADOR PENTEL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PORTAMINAS FABER CASTELL 0.7 MM FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('POS-IT 3M REF: 654 PAD X 1 COLORES SURTIDO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('POST IT GRANDE 70*100 657 COLORES 3M', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('POST IT PEQUEÃ‘O 40*50 - 653 3M', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('PROTECTOR DE VINILO T.CARTA DELGADO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('REGLA METALICA 30 CMS. K & CO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESALTADOR FABER TEXMARKER 49 AMARILLO FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESALTADOR FABER TEXMARKER 49 AZUL FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESALTADOR FABER TEXMARKER 49 NARANJA FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESALTADOR FABER TEXMARKER 49 ROSADO FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESALTADOR FABER TEXMARKER 49 VERDE FABER CASTELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESMA DE PAPEL REPROGRAF TAMAÃ‘O A4', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESMAS DE PAPEL PROPALCOTE CARTA DE 75', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESMAS DE PAPEL PROPALCOTE OFICIO DE 75', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('RESMAS OPALINA CARTA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLO DE PAPEL KRAF', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLO DE PAPEL TERMICO PARA FAX X 30MTS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLO MINI CONTACT 3 MTS TRANSPARENTE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLO PAPEL FOTOGRAFICO TAMAÃ‘O A3 OZALID', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLO PAPEL MASTER FOTOCOPIADORA RISOGRAF GR1700 KATUN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLOS DE PAPEL BOND DE 75 G- DE 60 CM X 50 METROS (TUBO INTERNO DE 5 CM DE DIAMETRO)', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROLLOS DE PAPEL BOND DE 75 G- DE 60 CM X 50 METROS (TUBO INTERNO DE 5 CM DE DIAMETRO) PARA PLOTTER HP DESIGNJET T2300', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('ROTULO ADHESIVO REF 67*25- ( 8.5\"X11\") X 30 HOJAS EL PAQUETE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SACAGANCHOS GENMES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SERVILLETA P/CAFETERIA BLANCA X 100 UNIDADES FAMILIA REF 72050', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SHAMPOO PARA ALFOMBRA 500 CC', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE CATALOGO CARTA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE CATALOGO OFICIO NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE CORRESPONDENCIA 20 A T.OFICIO C/VENTANILLA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 17.5X24 T.MEDIA CARTA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 22.5X29 T.CARTA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 25X31 T.CARTA ESPECIAL NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 25X35 T.OFICIO NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 30X42 T.GIGANTE NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRE NORMA ECOLOGICO 36X44 T.RADIOGRAFIA NORMA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRES BLANCO OFICIO 25 * 31 SELLASTRIMP', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('SOBRES BLANCO OFICIO 25 * 35 SELLASTRIMP', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TABLAS DE APOYOÂ  OFICIO ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TAPABOCAS CAJA *50 FACE MARK', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TARJETERO X 320 TARJETAS EN PLASTICO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TIJERA MANGO PLASTICO 7 TRITON', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA CHINA 5 X COLOR AMARILLO- AZUL- ROJO- BLANCO- NEGRO- VERDE', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA PELIKAN AZUL PARA SELLOS 28 CC PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA PELIKAN NEGRA PARA SELLOS 28 CC PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA PELIKAN ROJA PARA SELLOS 28 CC PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA PELIKAN VERDE PARA SELLOS 28 CC PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TINTA PELIKAN VIOLETA PARA SELLOS 28 CC PELIKAN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TOALLA DE MANOS DOBLADA EN Z REF 30206006 - 20-5 X24-5 CMS.', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TOALLA DE MANOS RECICLAJE- MEDIDA (20-5 X 24-5 CM) COLOR BLANCA REF 30205992', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TOALLA ROLLO P/MANOS BLANCA SCOTT 2H 100 MTS REF 30208404', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER 05A PARA IMPRESORA HP LASER JET P2035', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER 80X PARA IMPRESORA HP LASER JET PRO 400 M401DN', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER DE LA IMPRESORA HP COLOR LASER JET CP4525 - REFERENCIA CE 260A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER DE LA IMPRESORA HP COLOR LASER JET CP4525 - REFERENCIA CE 261A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER DE LA IMPRESORA HP COLOR LASER JET CP4525 - REFERENCIA CE 263A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER DE LA IMPRESORA HP COLOR LASER JET CP4525- REFERENCIA CE 262A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP 8543X NEGRO LASER HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP CC530A NEGRO HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP CC531A CYAN HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP CC532A AMARILLO HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP CC533A MAGENTA HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP Q2613A SERIE 1300 HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP Q5949A HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER HP5945A LJ 4345 HEWLETT PACKARD', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP LASER JET P2035N CE505A ', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP LASERJET 80X NEGRO TONER HP CF280A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP LASERJET P 2055 HP LASERJET 05A CE505A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP LASERJET P2055 DN HP 05X LASERJET (CE505XD)', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICE JET ALL-  IN-ONE â€“ J3680 COLOR REF: 22 â€“ C9352A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICE JET ALL-  IN-ONE â€“ J3680. REF: 21 â€“ C9351A', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICEJET 7110 932 XL TINTA AMARILLA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICEJET 7110 932 XL TINTA AZUL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICEJET 7110 932 XL TINTA MAGNETA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA HP OFFICEJET 7110 932 XL TINTA NEGRA', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER IMPRESORA LASER JET PRO 400- M401DN HP 80X - HP CF280X', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TONER LASER DELL 3110/3115 NEGRO REF.PF028 DELL', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('TRAPERO COMPLETO ARCOASEO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VARSOL X 3750 CC ORION', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VASO 4 ONZAS ICOPOR PAQ X 20 UND VARIOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VASO 7 ONZAS *50 TUCK', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VASOS DESECHABLE 4 ONZAS - BIODEGRADABLE - PAQUETE X 25 UNIDADES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VASOS DESECHABLESÂ  7 ONZAS - BIODEGRADABLE - PAQUETE X 25 UNIDADES', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VELAS PEQUEÃ‘AS PAQUETE X 12', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VINILO X 120GR 6 POR COLOR AMARILLO- AZUL- ROJO- BLANCO- NEGRO', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL),
                ('VINILOS MEDIANOS', '37', '1', NULL, NULL, 1, '2023-05-26', NULL, NULL, NULL, NULL, 1, 100, NULL, NULL, NULL)";
                    $stmt = $this->pdo->prepare($insumos);
                    $stmt->execute();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }

    public function TblUnidades($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'nombre',
                'abreviatura',
                'uso'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE unidades_medida (
                    id INT(11) PRIMARY KEY AUTO_INCREMENT,
                    nombre VARCHAR(255) NOT NULL,
                    abreviatura VARCHAR(10) NOT NULL,
                    uso VARCHAR(255) NOT NULL
                  )";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();

                $datos = "INSERT INTO unidades_medida (nombre, abreviatura, uso)
            VALUES
            ('Unidad', 'UN', 'Insumos generales como papelería, ferretería, etc.'),
            ('Mililitro', 'ml', 'Medicamentos, soluciones, productos de limpieza, etc.'),
            ('Litro', 'L', 'Medicamentos, soluciones, productos de limpieza, etc.'),
            ('Gramo', 'g', 'Medicamentos, suplementos alimenticios, especias, etc.'),
            ('Miligramo', 'mg', 'Medicamentos, suplementos alimenticios, vitaminas, etc.'),
            ('Microgramo', 'mcg', 'Medicamentos, vitaminas, hormonas, etc.'),
            ('Kilogramo', 'kg', 'Productos químicos, ingredientes alimenticios, etc.'),
            ('Metro', 'm', 'Telas, cuerdas, tuberías, etc.'),
            ('Centímetro', 'cm', 'Telas, cuerdas, tuberías, etc.'),
            ('Milímetro', 'mm', 'Telas, cuerdas, tuberías, etc.'),
            ('Pies cuadrados', 'ft²', 'Materiales de construcción, pisos, techos, etc.'),
            ('Pulgadas cuadradas', 'in²', 'Materiales de construcción, piezas pequeñas, etc.'),
            ('Pies cúbicos', 'ft³', 'Materiales de construcción, cajas, recipientes, etc.'),
            ('Pulgadas cúbicas', 'in³', 'Materiales de construcción, piezas pequeñas, etc.'),
            ('Metro cuadrado', 'm²', 'Pisos, azulejos, paredes, etc.'),
            ('Metro cúbico', 'm³', 'Cajas, recipientes, depósitos, etc.'),
            ('Libra', 'lb', 'Productos alimenticios, herramientas, etc.'),
            ('Onza', 'oz', 'Productos alimenticios, herramientas, etc.'),
            ('Galón', 'gal', 'Líquidos, combustibles, etc.'),
            ('Hora', 'hr', 'Servicios, trabajo por hora, etc.'),
            ('Minuto', 'min', 'Servicios, tiempo de espera, etc.'),
            ('Segundo', 'seg', 'Servicios, tiempo de espera, etc.'),
            ('Docena', 'dz', 'Productos alimenticios, herramientas, etc.'),
            ('Par', 'par', 'Calzado, guantes, equipos deportivos, etc.')";
                $stmt = $this->pdo->prepare($datos);
                $stmt->execute();
            }
            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblNivelacademico($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'nivel',
                'estudio',
                'curso_vigilancia',
                'lugar',
                'fecha',
                'usuario_id'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `nivel_academico` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nivel` varchar(255) NOT NULL,
                    `estudio` varchar(255) NOT NULL,
                    `curso_vigilancia` varchar(255) NOT NULL,
                    `lugar` varchar(255) NOT NULL,
                    `fecha` date NOT NULL,
                    `usuario_id` int(11) NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblKardex($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'insumo_id',
                'tipo_movimiento',
                'cantidad',
                'costo_unitario',
                'total',
                'fecha',
                'ubicacion_id',
                'proveedor_id',
                'responsable',
                'lote',
                'caducidad',
                'motivo'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE $tableName (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `insumo_id` int(11) NOT NULL,
                    `tipo_movimiento` enum('entrada','salida') NOT NULL,
                    `cantidad` int(11) NOT NULL,
                    `costo_unitario` decimal(10, 2) NOT NULL,
                    `total` decimal(10, 2) NOT NULL,
                    `fecha` datetime NOT NULL,
                    `ubicacion_id` int(11) NOT NULL,
                    `proveedor_id` int(11) NOT NULL,
                    `responsable` varchar(50) NOT NULL,
                    `lote` varchar(255) NOT NULL,
                    `caducidad` varchar(255) DEFAULT NULL,
                    `motivo` varchar(50) DEFAULT NULL,
                    PRIMARY KEY (`id`)                                                        
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }
            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function TblUsuarioRotativo($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'usuario_id',
                'estado'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `usuario_rotativo` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `usuario_id` int(11) NOT NULL,
                    `estado` int(11) NOT NULL COMMENT '1=activo,0=inactivo',
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `usuario_id` (`usuario_id`)
                   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }
    public function Tbltipoinsumo_asignado($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'tipo_insumo',
                'estado'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `tipoinsumo_asignado` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `tipo_insumo` varchar(255) NOT NULL COMMENT 'farmaceutico,oficina,industria',
                    `estado` int(11) NOT NULL COMMENT '1=activo,0=inactivo',
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `tipo_insumo` (`tipo_insumo`)
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='se guarda el tipo de insumo que se va usar'";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }
            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
            try {
                // Verificar si la clave única ya existe en la tabla
                $checkUniqueKey = "SELECT COUNT(*) as count FROM information_schema.statistics
                WHERE table_name = 'tipoinsumo_asignado' AND index_name = 'unique_tipo_insumo'";
                $stmt = $this->pdo->prepare($checkUniqueKey);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result['count'] == 0) {
                    // Agregar clave única a la columna `tipo_insumo`
                    $alterTable = "ALTER TABLE `tipoinsumo_asignado`
                    ADD UNIQUE KEY `unique_tipo_insumo` (`tipo_insumo`)";
                    $stmt = $this->pdo->prepare($alterTable);
                    $stmt->execute();
                }

                // Insertar o actualizar registros
                // $tipoInsumo = "INSERT INTO `tipoinsumo_asignado` (`tipo_insumo`, `estado`) VALUES
                // ('clinicos', 0),
                // ('oficina', 1),
                // ('industria', 0)
                // ON DUPLICATE KEY UPDATE
                // `tipo_insumo` = VALUES(`tipo_insumo`), `estado` = VALUES(`estado`)";
                // $stmt = $this->pdo->prepare($tipoInsumo);
                // $stmt->execute();
            } catch (Exception $e) {
                // Manejar la excepción
                echo "Error: " . $e->getMessage();
            }
        } catch (Exception $e) {
        }
    }
    public function Tblubicacion_asignado($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'ubicacion_id',
                'estado'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `ubicacion_asignado` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `ubicacion_id` int(11) NOT NULL COMMENT 'el id de la ubicacion que va ha usar para el inv rotativo',
                    `estado` int(11) NOT NULL COMMENT '1=activo,0=inactivo',
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `ubicacion_id` (`ubicacion_id`)
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='se guarda las ubicaciones que se van usar'";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }

    public function TblSegmentos($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */
        try {
            // Check if table exists
            $column = array(
                'id',
                'nombre'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `segmentos` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `nombre` varchar(255) NOT NULL ,                    
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `nombre` (`nombre`)
                   ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                echo "Error en la consulta: " . $error[2];
            }
        } catch (Exception $e) {
        }
    }


    public function TblFormatosRestricion($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */


        try {
            // Check if table exists
            $column = array(
                'id',
                'usuario_id',
                'formato_id'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(50)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `usuario_id` int(11) NOT NULL,
                `formato_id` int(11) NOT NULL,
                PRIMARY KEY (`id`)
               ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                throw new PDOException("Error en la consulta: " . $error[2]);
            }
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    }


    public function TblNotificaciones($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */

        try {
            // Check if table exists
            $column = array(
                'id',
                'modulo_id',
                'usuario_id',
                'proceso_id',
                'email',
                'accion'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(100)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
                $campo = "ALTER TABLE `notificaciones` CHANGE `usuario_id` `usuario_id` VARCHAR(250) NOT NULL";
                $stmt = $this->pdo->prepare($campo);
                $stmt->execute();
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `notificaciones` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `modulo_id` int(11) NOT NULL,
                    `usuario_id` varchar(250) NOT NULL,
                    `proceso_id` int(11) DEFAULT NULL,
                    `email` varchar(100) NOT NULL,
                    `accion` varchar(255) NOT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                throw new PDOException("Error en la consulta: " . $error[2]);
            }
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    }

    public function TblCarteleras($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */

        try {
            // Check if table exists
            $column = array(
                'id',
                'titulo',
                'contenido',
                'vigencia',
                'fecha_registro',
                'usuario_id'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(100)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `carteleras` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `titulo` varchar(255) NOT NULL,
                    `contenido` text NOT NULL,
                    `vigencia` date NOT NULL,
                    `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
                    `usuario_id` int(11) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                throw new PDOException("Error en la consulta: " . $error[2]);
            }
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    }
    public function TblEspecificaciones($tableName)
    {
        /** 1 validar si la tabla existe */
        /** 1.1 crearla si no 
         *  1.1.1 si la tbl existe  validar que tenga todos los campos
         *  1.1.2 si la tbl existe  validar que tenga todos los campos si no crearlos
         */

        try {
            // Check if table exists
            $column = array(
                'id',
                'producto_id',
                'ubicacion_especifica',
                'uso',
                'clasificacion_riesgo',
                'marca',
                'modelo',
                'material',
                'color',
                'lugar_origen',
                'inicio_mantenimiento',
                'frecu_mantenimiento',
                'resolucion',
                'presicion',
                'bateria',
                'reg_DIAN',
                'rango_ini_calibracion',
                'rango_fin_calibracion',
                'rango_ini_medicion',
                'rango_fin_medicion',
                'tipo_certificado',
                'link'
            );
            $tableExists = false;
            $stmt = $this->pdo->prepare("SHOW TABLES LIKE :tableName");
            $stmt->execute(['tableName' => $tableName]);
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                $tableExists = true;
                $tbl_doc_online = "describe $tableName";
                $stmt = $this->pdo->prepare($tbl_doc_online);
                $stmt->execute();
                while ($fields = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $current_columns[] = $fields->Field;
                }
                foreach ($column as $models) {
                    // Compare existing columns to desired state, and create if necessary   
                    if (!in_array($models, $current_columns)) {
                        $campo = "ALTER TABLE $tableName ADD $models VARCHAR(100)  NULL";
                        $stmt = $this->pdo->prepare($campo);
                        $stmt->execute();
                    }
                }
                // $campo = "ALTER TABLE `notificaciones` CHANGE `usuario_id` `usuario_id` VARCHAR(250) NOT NULL";
                // $stmt = $this->pdo->prepare($campo);
                // $stmt->execute();
            }
            // If table does not exist, create it
            if (!$tableExists) {
                // echo 'NO EXISTE LA TBL' . $tableName;
                $sql = "CREATE TABLE `especificaciones` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `producto_id` int(11) NOT NULL,
                    `ubicacion_especifica` varchar(255) NOT NULL,
                    `uso` varchar(255) NOT NULL,
                    `clasificacion_riesgo` varchar(255) NOT NULL,
                    `marca` varchar(255) NOT NULL,
                    `modelo` varchar(255) NOT NULL,
                    `material` varchar(255) NOT NULL,
                    `color` varchar(255) NOT NULL,
                    `lugar_origen` varchar(255) NOT NULL,
                    `inicio_mantenimiento` varchar(255) NOT NULL,
                    `frecu_mantenimiento` varchar(255) NOT NULL,
                    `resolucion` varchar(255) NOT NULL,
                    `presicion` varchar(255) NOT NULL,
                    `bateria` varchar(255) NOT NULL,
                    `reg_DIAN` varchar(255) NOT NULL,
                    `rango_ini_calibracion` varchar(255) NOT NULL,
                    `rango_fin_calibracion` varchar(255) NOT NULL,
                    `rango_ini_medicion` varchar(255) NOT NULL,
                    `rango_fin_medicion` varchar(255) NOT NULL,
                    `tipo_certificado` varchar(255) NOT NULL,
                    `link` varchar(500) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `producto_id_2` (`producto_id`),
                    KEY `producto_id` (`producto_id`)
                   ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
            }

            $error = $stmt->errorInfo();
            if ($error[0] != "00000") {
                throw new PDOException("Error en la consulta: " . $error[2]);
            }
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    }
}
