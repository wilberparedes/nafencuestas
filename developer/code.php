<?php
session_start();
date_default_timezone_set('Pacific/Honolulu');
header('content-type: application/json; charset=utf-8');


require_once 'PDOConn.php';


if(isset($_GET['case'])){
    $case=$_GET['case'];
}
if(isset($_GET['estado'])){
    $estado=$_GET['estado'];
}


if(isset($_POST['codmenu'])){
  $codmenu = $_POST['codmenu'];
}


$createtable = array(
  'data' => array()
);

switch ($case) {

    case 'enviarEncuesta':

      if(isset($_POST['preg1'])){
        $preg1 = $_POST['preg1'];
      }

      if(isset($_POST['preg2'])){
        $preg2 = $_POST['preg2'];
      }

      if(isset($_POST['preg3'])){
        $preg3 = $_POST['preg3'];
      }

      if(isset($_POST['preg4'])){
        $preg4 = $_POST['preg4'];
      }

      if(isset($_POST['preg5'])){
        $preg5 = $_POST['preg5'];
      }

      if(isset($_POST['preg6'])){
        $preg6 = $_POST['preg6'];
      }

      if(isset($_POST['cualotro'])){
        $cualotro = $_POST['cualotro'];
        if($cualotro == ''){
          $cualotro = NULL;
        }
      }else{
        $cualotro = NULL;
      }
      


      $codencuesta = $_SESSION['idencuestaNaf'];
      $token = $_SESSION['tokenNaf'];
      
      $select = "SELECT * FROM encuestas WHERE codigo_enc = :cod AND token = :token";
      $paramss = array(':cod' => $codencuesta, ':token' => $token);
      $row = row($select, $paramss);

      if($row != ''){
        $update = "UPDATE encuestas SET estado = :estado WHERE codigo_enc = :codrol";
        $params = array(':estado' => 1, ':codrol'=>$codencuesta);

        if(query($update, $params)){

          $insert = "INSERT INTO calificacion (codencuesta_cal, fecha_cal, preg1_cal, preg2_cal, preg3_cal, preg4_cal, preg5_cal, preg6_cal, otro) values (:codencuesta, :fecha, :preg1, :preg2, :preg3, :preg4, :preg5, :preg6, :otro)";
          $paramsinsert = array(':codencuesta' => $codencuesta, ':fecha' => datetimeNow(), ':preg1' => $preg1, ':preg2' => $preg2, ':preg3' => $preg3, ':preg4' => $preg4, ':preg5' => $preg5, ':preg6' => $preg6, ':otro' => $cualotro);

          if(query($insert, $paramsinsert)){

            $json = json_encode(array("success"=>true));

            unset($_SESSION['idencuestaNaf']);  
            unset($_SESSION['tokenNaf']);  

          }else{
            $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo. 2"));
          }
        }else{
          $json = json_encode(array("success"=>false,"mensaje" => "No se Actualizó la información. Por favor, intentelo de nuevo"));
        }
      }else{
        $json = json_encode(array("success"=>false,"mensaje" => "Acceso prohibido."));
      }

    break;


    

}
echo $json;

?>

