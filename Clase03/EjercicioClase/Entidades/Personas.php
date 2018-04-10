<?php
class Persona
{
    private $nombre;
    private $apellido;
    private $legajo;
    private $dni;

    public function __construct($nombre, $apellido, $legajo, $dni)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->legajo = $legajo;
        $this->dni = $dni;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop = $value;
    }

    public function __toString()
    {
        return "$this->nombre-$this->apellido-$this->legajo-$this->dni" . PHP_EOL;
    }

    public static function LeerArchivo($file)
    {
        $fp = fopen($file, "r");
        while (!feof($fp)) {
            $personaDatos = explode("-", fgets($fp));
            if (count($personaDatos) == 4) {
                $personas[] = new Persona($personaDatos[0], $personaDatos[1], $personaDatos[2], $personaDatos[3]);
            }
        }
        fclose($fp);
        return $personas;
    }

    public static function BajarPersonas($ppl, $file)
    {
        $fp = fopen($file, "w");
        foreach ($ppl as $peep) {
            fwrite($fp, "$peep");
        }
        fclose($fp);
    }

    public static function BuscarPorLegajo($ppl, $legajo)
    {
        foreach ((array) $ppl as $key) {
            if ((int) $key->legajo == (int) $legajo) {
                return $key;
            }
        }
        return null;
    }

    public static function CargarPersona($p)
    {
        $ret = false;
        $ppl = self::LeerArchivo("Lista.txt");
        if (self::BuscarPorLegajo($ppl, $p->legajo)) {
            echo "La persona ya se encuentra en la lista";
        } else {
            $ppl[] = $p;
            $ret = true;
        }
        self::BajarPersonas($ppl, "Lista.txt");
        return $ret;
    }

    public static function ModificarPersona($p)
    {
        $ret = false;
        $ppl = self::LeerArchivo("Lista.txt");
        $persona = self::BuscarPorLegajo($ppl, $p->legajo);
        echo "$persona";
        if ($persona == null) {
            echo "No se encuentra la persona que quiere modificar.";
        } else {
            $key = array_search($persona, $ppl);
            $persona = $p;
            $ret = true;
            $ppl[$key] = $persona;
        }
        self::BajarPersonas($ppl, "Lista.txt");
        return $ret;
    }

    public static function BorrarPersona($p)
    {
        $ret = false;
        $ppl = self::LeerArchivo("Lista.txt");
        if (self::BuscarPorLegajo($ppl, $p->legajo)) {
            $key = array_search($p, $ppl);
            echo $key;
            unset($ppl[$key]);
            $ret = true;
        } else {
            echo "La persona no se encuentra en la lista";
        }

        self::BajarPersonas($ppl, "Lista.txt");
        return $ret;
    }

}
