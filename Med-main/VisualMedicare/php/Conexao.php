<?php
class Conexao {
    private static $servidor = "localhost";
    private static $banco    = "clinica";
    private static $usuario  = "root";
    private static $senha    = "root";


public static function getConexao()
 {
  $conectar = new PDO("mysql:host=" . self::$servidor . ";dbname=" . self::$banco, self::$usuario, self::$senha);
   return $conectar;
 }
}
?>