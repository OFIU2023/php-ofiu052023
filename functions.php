<?php 
// mysqli() crear constructor para establcer la conexion
  //$mysqli = new mysqli("localhost", "id18106981_adm", "pTXh1~%Xp!A^EX=/", "id18106981_ofiu");
/*$mysqli = new mysqli("localhost", "id17765157_admin", "H/[h4qv=IxykBcAC", "id17765157_bd_ofiu");
    if ($mysqli->connect_error) {//Desiciion para conocer el resultado de la conexion 
        die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);// Mostrar el error que se pueda generar
    }
*/


 #conexion base de datos#
    function conexion(){
        $pdo= new PDO('mysql:host=localhost;dbname=ofiu','root','');
        return $pdo;
    }



#verificar datos formato o filtro   enviado delo que se piden en los inputs
    function verificar_datos($filtro , $cadena){
        if(preg_match("/^".$filtro."$/", $cadena ) ){
            return false;
        }else{
            return true;
        }

    }

    
#limoiar cadenas de texto INyeccion sql#
function limpiar_cadena($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=str_ireplace("<script>", "", $cadena);
    $cadena=str_ireplace("</script>", "", $cadena);
    $cadena=str_ireplace("<script src", "", $cadena);
    $cadena=str_ireplace("<script type=", "", $cadena);
    $cadena=str_ireplace("SELECT * FROM", "", $cadena);
    $cadena=str_ireplace("DELETE FROM", "", $cadena);
    $cadena=str_ireplace("INSERT INTO", "", $cadena);
    $cadena=str_ireplace("DROP TABLE", "", $cadena);
    $cadena=str_ireplace("DROP DATABASE", "", $cadena);
    $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena=str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
    $cadena=str_ireplace("<?php", "", $cadena);
    $cadena=str_ireplace("?>", "", $cadena);
    $cadena=str_ireplace("--", "", $cadena);
    $cadena=str_ireplace("^", "", $cadena);
    $cadena=str_ireplace("<", "", $cadena);
    $cadena=str_ireplace("[", "", $cadena);
    $cadena=str_ireplace("]", "", $cadena);
    $cadena=str_ireplace("==", "", $cadena);
    $cadena=str_ireplace(";", "", $cadena);
    $cadena=str_ireplace("::", "", $cadena);
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    return $cadena;

}
function variables_session($datos){
    $_SESSION['id_usuario']=$datos['id_usuario'];
    $_SESSION['nombre']=$datos['nombre'];
    $_SESSION['apellido']=$datos['apellido'];
    $_SESSION['correo']=$datos['correo'];
    $_SESSION['tipo_user']=$datos['tipo_user'];
    $_SESSION['desc_cliente']=$datos['desc_cliente'];

}




function verificar_usuario($id_prof){

    $verificar_vali= conexion();
    
// verificsr si existe ya la cuenta profesional, si no, crearlaa y mandarlo a la vista de verificar 
    $verificar_vali= $verificar_vali->query("SELECT * FROM profesional WHERE id_profesional='$id_prof'");
    $verificar_vali=$verificar_vali->fetch();
    if($verificar_vali['verificado']!="SI" ){
        return "NO";
    }else{
        return "SI";
    }


    }






?>
