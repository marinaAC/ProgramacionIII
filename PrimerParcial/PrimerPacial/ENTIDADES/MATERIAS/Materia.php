<?php
    
    class Materia
    {
        private $materia;
        private $codigoMateria;
        private $cupoAlumnos;
        private $aula;

        public function __construct($materia,$codigoMateria,$cupoAlumnos,$aula)
        {
            $this->materia = $materia;
            $this->codigoMateria = $codigoMateria;
            $this->cupoAlumnos = $cupoAlumnos;
            $this->aula = $aula;
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
            return "$this->materia-$this->codigoMateria-$this->cupoAlumnos-$this->aula".PHP_EOL;
        }

    }
    

?>