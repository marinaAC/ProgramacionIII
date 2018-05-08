<?php
    include_once("ENTIDADES/ALUMNO/Alumno.php");
    include_once("ENTIDADES/ALUMNO/AlumnoFile.php");
    include_once("ENTIDADES/MATERIAS/Materia.php");
    include_once("ENTIDADES/MATERIAS/MateriasFile.php");
    include_once("ENTIDADES/INSCRIPCIONES/Inscripcion.php");
  
    
  
    define("fileVentas","ENTIDADES/HELADOS/vendidos.txt");
    define("URLIMGBORRADAS","ENTIDADES/HELADOS/heladosBorrados/");

    
    class Accion
    {
        
        public static function MetodoPost($accion)
        {
            switch($accion)
            {
                /**
                 * CARGA DE ALUMNO
                 */
                case "cargarAlumno":
                    $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["correo"],$_POST["foto"]);
                    if(AlumnoFile::GuardarEnArchivo($alumno))
                    {
                        echo "Guardo Alumno";
                    }else{
                        echo "Nop";
                    }
                    break;
                /*
                 * CARGA DE MATERIA
                 */
                case "cargarMateria":
                    $materia = new Materia($_POST["materia"], $_POST["codMateria"], $_POST["cupoAlumnos"], $_POST["aula"]);
                    if(!MateriasFile::GuardarEnArchivo($materia))
                    {
                        echo "\nHubo un problema con la carga de la materia".$materia;
                    }
                    break;
                case "modificarAlumno":
                    $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["correo"],$_POST["foto"]);
                    if(!AlumnoFile::ModificarAlumnos($alumno)){
                        echo "no lo logro";
                    }
                    break;
                default:
                    echo "No entro a ninguno de los casos anteriores";
                    break;
            }
        }

        public static function MetodoGet($accion)
        {
            switch($accion)
            {
                case "consultarAlumno":
                    $apellido = $_GET["apellido"];
                    $aux = AlumnoFile::ConsultarAlumnos($apellido);
                    if($aux == null){
                        echo "No se encontro el alumno";
                    }
                    break;
                case "inscribirAlumno":
                    $nombre = $_GET["nombre"];
                    $apellido = $_GET["apellido"];
                    $correo = $_GET["correo"];
                    $materia = $_GET["materia"];
                    $codigo = $_GET["codigo"];
                    if(!Inscripcion::InscribirAlumno($nombre,$apellido,$correo,$materia,$codigo)){
                        echo "No se encontro la materia";
                    }
                    break;
                case "inscripciones";
                    $materia = $_GET["materia"];
                    $apellido = $_GET["apellido"];
                    $tabla = Inscripcion::Inscripciones($materia,$apellido);
                    echo "$tabla";
                    break;
                default:
                    echo "No entro a ninguno de los casos anteriores";
                break;
            }
        }

    }


?>