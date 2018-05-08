<?php
    include_once("Alumno.php");
    include_once("./ARCHIVOS/accionesArchivos.php");

    /**
     * DEFINE DEL ARCHIVO DE TEXTO
     */
    define("AALUMNOS","ENTIDADES/ALUMNO/alumnos.txt");
    define("FOTOS","ENTIDADES/ALUMNO/fotos");
    define("BKUP","ENTIDADES/ALUMNO/backupFotos/");

    class AlumnoFile
    {
        //CAMBIAR NOMBRE A CARGAR ALUMNO
        public static function GuardarEnArchivo($alumno)
        {
            $retorno = true;
            $fileClass = new AccionesArchivos(AALUMNOS);
            AccionesArchivos::UploadFile("archivo",$alumno->correo,FOTOS);
            if(!$fileClass->addLineFile($alumno))
            {   
                echo "No pudo guardarse la linea del nuevo alumno";
                $retorno = false;
            }
            return $retorno;
        }

        public static function LeerAlumnos($file)
        {
            $fp =fopen($file,"r");
            $listaAlumnos = [];
            while(!feof($fp))
            {
                $alumnosDatos = explode("-", fgets($fp));
                if (count($alumnosDatos) == 4) {
                    $listaAlumnos[] = new Alumno($alumnosDatos[0], $alumnosDatos[1], $alumnosDatos[2], $alumnosDatos[3]);
                }
            }
            fclose($fp);
            return $listaAlumnos;
        }

        public static function ConsultarAlumnos($apellido)
        {
            $listaCoincidencias = [];
            if($apellido != null && file_exists(AALUMNOS)){
                $listaAlumnos = self::LeerAlumnos(AALUMNOS);
                var_dump($listaAlumnos);
                foreach($listaAlumnos as $key){
                    if($apellido == $key->apellido){
                        array_push($listaCoincidencias,$key);
                    }
                }
            }else{
                echo "datos mal ingresados o archivo inexistente";
            }
            return $listaCoincidencias;
        }

        public static function ModificarAlumnos($alumno)
        {
            $return = false;

            $listaAlumnos = self::LeerAlumnos(AALUMNOS);
            foreach ($listaAlumnos as $key) 
            {
                if($key->nombre==$alumno->nombre||$key->apellido==$alumno->apellido)
                {
                    $auxCorreo = $key->correo;
                    $key->nombre = $alumno->nombre;
                    $key->apellido = $alumno->apellido;
                    $key->foto = $alumno->foto;
                    $key->correo = $auxCorreo;
                    AccionesArchivos::ModificarFile("archivo",$alumno->correo,FOTOS,$alumno->correo,BKUP);
                    $return = true;
                    echo "Lo encontro ";
                    break;
                }
            }
            $fileObj = new AccionesArchivos(AALUMNOS);
            $return = $fileObj->saveFile($listaAlumnos);
            return $return;
        }

        public static function MostrarAlumnos()
        {
            $listaAlumnos = self::LeerAlumnos(AALUMNOS);
            $tabla = "<table><thead><tr><td>NOMBRE</td><td>APELLIDO</td><td>CORREO</td><td>IMAGEN</td></tr></thead><tbody>";
            foreach ($listaAlumnos as $key) {
                $tabla .= "<tr><td>".$key->nombre."</td>";
                $tabla .= "<td>".$key->apellido."</td>";
                $tabla .= "<td>".$key->correo."</td>";
                $aux = trim($key->foto);
                $tabla .= "<td><img style='height:10%;width:10%'  src='http://localhost/PracticaParcialCasa/ENTIDADES/HELADOS/heladosImagen/".$aux.".jpeg'>".$aux."</td></tr>";
            }
            $tabla .= "</tbody></tabla>";
            return $tabla;
        }

    }


?>