<?php
    include_once './DAO/Entidades/HistorialDao.php';
    class SecurityHistorial{
        public static function GenerarHistorial($request,$response,$next){
            $respuesta = $next($request,$response);
            $payload = $request->getAttribute("verificarToken")["VerificarToken"];
            if($payload != null){
                $id_Usuario = $payload->idUsuario;
            }
            else{
                $id_Usuario = null;
            }
            $metodo = $request->getMethod();
            $ruta = $request->getUri();
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $hora = date('H:i');
            $bd = new ConexionDb('examen','root','');
            $hisDao = new HistorialDao($bd);
            $usuario = $hisDao->SaveHistorial(new Historial($id_Usuario,$metodo,$ruta,$hora));
            return $respuesta;
        }
    }
?>