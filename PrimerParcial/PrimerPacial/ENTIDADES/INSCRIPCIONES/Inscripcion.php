<?php
    include_once("ENTIDADES/ALUMNO/Alumno.php");
    include_once("ENTIDADES/ALUMNO/AlumnoFile.php");
    include_once("ENTIDADES/MATERIAS/Materia.php");
    include_once("ENTIDADES/MATERIAS/MateriasFile.php");
    include_once("./ARCHIVOS/accionesArchivos.php");

    define("AINSCRIPCIONES","ENTIDADES/INSCRIPCIONES/inscripciones.txt");
  
    
    class Inscripcion
    {
        private $nombre;
        private $apellido;
        private $correo;
        private $materia;
        private $codMateria;

        public function __construct($nombre,$apellido,$correo,$materia,$codMateria)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->correo = $correo;
            $this->materia = $materia;
            $this->codMateria = $codMateria;
        }

        public function __get($prop)
        {
            return $this->$prop;
        }

        public function __set($prop,$value)
        {
            $this->$prop = $value;
        }

        public function __toString()
        {
            return "$this->nombre-$this->apellido-$this->correo-$this->materia-$this->codMateria".PHP_EOL;
        }

        public static function InscribirAlumno($nombre,$apellido,$correo,$materia,$codigo){
            $retorno = false;
            $listaInscripciones = MateriasFile::LeerMaterias(AMATERIAS);
            foreach($listaInscripciones as $m){
                if($m->codigoMateria==$codigo && $m->cupoAlumnos>0){
                    $m->cupoAlumnos--;
                    $retorno = true;
                    echo "se realizo la inscripcion";
                    break;
                }else if($m->codigoMateria==$codigo && $m->cupoAlumnos<=0){
                    echo "No hay mas cupo para la materia ".$m->codigoMateria;
                }
            }
            $fileObj = new AccionesArchivos(AMATERIAS);
            $fileObj->saveFile($listaInscripciones);
            if($retorno){
                $inscripcion = new Inscripcion($nombre,$apellido,$correo,$materia,$codigo);
                self::GuardarEnArchivo($inscripcion);
            } 
            return $retorno;
        }

        public static function GuardarEnArchivo($inscripcion)
        {
            $retorno = true;
            $fileClass = new AccionesArchivos(AINSCRIPCIONES);
            if(!$fileClass->addLineFile($inscripcion))
            {
                echo "No pudo guardarse la inscripcion\n";
                $retorno = false;
            }
            return $retorno;
        }

        

        public static function LeerInscripciones($file)
        {
            $fp =fopen($file,"r");
            $listaInscripciones = [];
            while(!feof($fp))
            {
                $inscripciones = explode("-", fgets($fp));
                if (count($inscripciones) == 5) {
                    $listaInscripciones[] = new Inscripcion($inscripciones[0], $inscripciones[1], $inscripciones[2], $inscripciones[3], $inscripciones[4]);
                }
            }
            fclose($fp);
            return $listaInscripciones;
        }

        public static function Inscripciones($materia,$apellido)
        {   
            $flag = false;
            if($materia == null || $apellido != null){
                $flag = true;
            }
            $listaIncripciones = self::LeerInscripciones(AINSCRIPCIONES);
            $tabla = "<table><thead><tr><td>ALUMNOS</td><td>MATERIAS</td></tr></thead><tbody>";
            foreach ($listaIncripciones as $key) {
                if($flag){
                    if($apellido != null && $materia==$key->materia){
                        $tabla .= "<tr><td>".$key->nombre.",".$key->apellido." ".$key->correo."</td>";
                        $tabla .= "<td>".$key->materia."</td></tr>";
                    }else if($apellido != null && $apellido == $key->apellido){
                        $tabla .= "<tr><td>".$key->nombre.",".$key->apellido." ".$key->correo."</td>";
                        $tabla .= "<td>".$key->materia."</td></tr>";
                    }
                }
                else{
                    $tabla .= "<tr><td>".$key->nombre.",".$key->apellido." ".$key->correo."</td>";
                    $tabla .= "<td>".$key->materia."</td></tr>";
                }
                
            }
            $tabla .= "</tbody></tabla>";
            return $tabla;
        }

    }
    

?>