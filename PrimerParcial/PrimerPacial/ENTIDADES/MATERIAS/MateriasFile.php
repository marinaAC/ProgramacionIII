<?php
    include_once("ARCHIVOS/accionesArchivos.php");
    include_once("ENTIDADES/MATERIAS/Materia.php");

    /**
     * DEFINE DEL ARCHIVO MATERIAS
     */
    define("AMATERIAS","ENTIDADES/MATERIAS/materias.txt");
    class MateriasFile{

        public static function GuardarEnArchivo($materia)
        {
            $retorno = true;
            $fileClass = new AccionesArchivos(AMATERIAS);
            if(!$fileClass->addLineFile($materia))
            {
                echo "No pudo guardarse la linea del nuevo materia";
                $retorno = false;
            }
            return $retorno;
        }

        public static function LeerMaterias($file)
        {
            $fp =fopen($file,"r");
            $listaMaterias = [];
            while(!feof($fp))
            {
                $materiasDatos = explode("-", fgets($fp));
                if (count($materiasDatos) == 4) {
                    $listaMaterias[] = new Materia($materiasDatos[0], $materiasDatos[1], $materiasDatos[2], $materiasDatos[3]);
                }
            }
            fclose($fp);
            return $listaMaterias;
        }



        public static function Borrarmateria($materia,$file)
        {
           $return = false;
           $listaMaterias = self::Leermaterias($file);
           foreach($listaMaterias as $key){
                if($key->nombre == $materia ->nombre){
                    $index = array_search($key,$listaMaterias);
                    unset($listaMaterias[$index]);
                    echo "lo borro de la lista ";
                    break;
                }
            }
            $fileObj = new AccionesArchivos($file);
            $return = $fileObj->saveFile($listaMaterias);
            return $return;
        } 
    }

?>