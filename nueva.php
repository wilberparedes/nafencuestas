<?php
session_start();
    include 'developer/PDOConn.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NAF | Corporación Universitaria Americana</title>
    <!-- Bootstrap Styles-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- TOAST STYLE -->
    <link href="../assets/css/toastr.min.css" rel="stylesheet" />


    <!-- JS Scripts-->
    <!-- jQuery Js -->
    
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootbox.min.js"></script>
    <script>
       
    </script>
    <!-- Metis Menu Js -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/custom-scripts.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- TOAST SCRIPTS -->
    <script src="../assets/js/toastr.min.js"></script>
    <!-- JS Scripts-->
    <script>
    	var ant;
        function fCalificacion(data){
        	console.log(data);
        	
        	$('#btncal'+ant).removeClass('active');

        	$('#btncal'+data).addClass('active');

        	ant = data;

            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "../developer/Lopersa/enviarEncuesta",
                type: "POST",
                data: { 'cal' : data}
            })
            .done(function(data) {
                if(data.success == true){
                    $('.desactivarC').fadeOut(500);
                    toastr.success("Encuesta enviada exitosamente.", "NAF");
                    $("#contenido").hide();
                    $("#gracias").show();

                }else{
                   toastr.error( "Request failed: " + data.mensaje); 
                }
            })
            .fail(function( jqXHR, textStatus ) {
                $('.desactivarC').fadeOut(500);
                toastr.error( "Request failed: " + jqXHR.responseText);
            });

        }

        $(function(){
            $("input[name='preg1']").change(function(){
                $('.divPreg1').removeClass('error');
                $('.divPreg1').addClass('true');
            });
            $("input[name='preg2']").change(function(){
                $('.divPreg2').removeClass('error');
                $('.divPreg2').addClass('true');
            });
            $("input[name='preg3']").change(function(){
                $('.divPreg3').removeClass('error');
                $('.divPreg3').addClass('true');
            });
            $("input[name='preg4']").change(function(){
                $('.divPreg4').removeClass('error');
                $('.divPreg4').addClass('true');
            });
            $("input[name='preg5']").change(function(){
                $('.divPreg5').removeClass('error');
                $('.divPreg5').addClass('true');
            });
            $("input[name='preg6']").change(function(){
                $('.divPreg6').removeClass('error');
                $('.divPreg6').addClass('true');
            });

            $("input[name='preg5']").change(function(){
                if($(this).val() == 1){
                    $('.otro').fadeIn();
                }else{
                    $('.otro').fadeOut();
                }
            });



        });


        function enviarEncuesta(){
            
            if (!$('input[name=preg1]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 1'); 
                $('.divPreg1').addClass('error');
            }else if (!$('input[name=preg2]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 2'); 
                $('.divPreg2').addClass('error');
            }else if (!$('input[name=preg3]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 3'); 
                $('.divPreg3').addClass('error');
            }else if (!$('input[name=preg4]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 4'); 
                $('.divPreg4').addClass('error');
            }else if (!$('input[name=preg5]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 5'); 
                $('.divPreg5').addClass('error');
            }else if ($('input[name=preg5]:checked').val() == 1 && $("#cualotro").val() == '') {         
                toastr.error('Por favor, responda ¿Cuál otro?'); 
                $('.divPreg5').removeClass('true');
                $('.divPreg5').addClass('error');
            }else if (!$('input[name=preg6]:checked').val()) {         
                toastr.error('Por favor, responda la pregunta 6'); 
                $('.divPreg6').addClass('error');
            }else{

                $('.divPreg5').addClass('true');
                $('.divPreg5').removeClass('error');

                var preg1 = $('input[name=preg1]:checked').val();
                var preg2 = $('input[name=preg2]:checked').val();
                var preg3 = $('input[name=preg3]:checked').val();
                var preg4 = $('input[name=preg4]:checked').val();
                var preg5 = $('input[name=preg5]:checked').val();
                var preg6 = $('input[name=preg6]:checked').val();
                var cualotro = $('#cualotro').val();


                $('.desactivarC').fadeIn(500);
                $.ajax({
                    url: "../developer/Lopersa/enviarEncuesta",
                    type: "POST",
                    data: {
                        'preg1' : preg1,
                        'preg2' : preg2,
                        'preg3' : preg3,
                        'preg4' : preg4,
                        'preg5' : preg5,
                        'preg6' : preg6,
                        'cualotro' : cualotro
                    }
                })
                .done(function(data) {
                    if(data.success == true){
                        window.scrollTo(0, 0);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('.desactivarC').fadeOut(500);
                        toastr.success("Encuesta enviada exitosamente.", "NAF");
                        $("#contenido").hide();
                        $("#gracias").show();
                    }else{
                       toastr.error( "Request failed: " + data.mensaje); 
                    }
                })
                .fail(function( jqXHR, textStatus ) {
                    $('.desactivarC').fadeOut(500);
                    toastr.error( "Request failed: " + jqXHR.responseText);
                });




            }
        }

        

    </script>

    <style>
	    .cal{
			background: #002b59;
			color: #fff;
			border: none;
			padding: 15px 0px;
			font-size: 40px;
			width: 100%;
			margin-bottom: 10px;
	    }
	    .cal:hover, .active{
	    	background: #b79e4c;
	    	transition: all 300ms ease-in-out;
	    }
        .error{
            background-color: rgba(255, 0, 0, 0.5);
            border: 2px solid red;
            border-radius: 10px;
        }
        .true{
            background-color: rgba(4, 221, 45, 0.5);
            border: 2px solid green;
            border-radius: 10px;
        }
        .divpreg{
            margin-bottom: 10px;
        }
    </style>
    <!-- jQuery Js -->
</head>


<body onload="">
    <div class="desactivarC" style="height: 100%;width: 100%;position: fixed;top: 0;left: 0;background: rgba(255,255,255,0.8); z-index: 999999;display:none;"><img src="../assets/img/loading.gif" style="margin-left:50%; margin-top:300px;width: 60px;"></div>
    <div>
        
        <!--/. header -->
            <?php 
            include 'component/header.php' 
            ?>
        <!-- fin header -->
        
        <!-- /. Pagina  -->
        <div style="background: #E5EBF2;min-height: 1200px;padding: 5px 0px;">
            <div id="page-inner">

                <?php
                    $fecha1 = date('Y-m-d');

                    $params = explode(",", base64_decode($_GET["ema"]));
                    $_SESSION['idencuestaNaf'] = $params[1];
                    $idencuesta = $params[1];
                    $_SESSION['tokenNaf'] = $params[2];
                    $token = $_SESSION['tokenNaf'];
                    // echo print_r($params);

                    $select = "SELECT * FROM encuestas WHERE codigo_enc = :cod AND token = :token AND estado != 2";
                    $paramss = array(':cod' => $idencuesta, ':token' => $token);
                    $row = row($select, $paramss);

                    if($fecha1 > $row["fechaven_enc"]){

                        $update = "UPDATE encuestas SET estado = :estado WHERE codigo_enc = :cod";
                        $paramsup = array(':estado' => 2, ':cod' => $idencuesta);
                        if(query($update, $paramsup)){
                            echo 'Encuesta expirada.';
                        }else{
                            echo 'Encuesta expirada. false';
                        }
                    }else{

                        // echo $fecha1 . ' ' . $row["fecha_enc"];
                        // echo $row["estado"];
                        if($row == '' or $row["estado"] == 3){
                            // echo print_r($params);
                            echo 'Acceso prohibido';
                        }
                        else {
                            // if($row["estado"] == 0){

                            ?>

                            <div id="contenido" style="text-align:center; max-width:750px;margin: 0 auto; <?php if($row["estado"] == 0){ echo 'display:block;'; }else { echo 'display:none;'; }  ?>"  >
                                	
                            	<h2>Encuesta de valoración de los servicios Núcleos de Apoyo Contable y Fiscal –  NAF</h2>
                            	<p>Con el fin de mejorar la atención, agradecemos responder la siguiente evaluación de la manera más sincera posible: </p>
            					<br>
            					<div class="row" style="text-align:left;">
            						<div class="col-md-12 divPreg1 divpreg">
            							<p>1. ¿El NAF atendió su solicitud?</p>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg1">Sí</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="0" name="preg1">No</label>
                                        </div>
            						</div>

                                    <div class="col-md-12 divPreg2 divpreg">
                                        <p>2. ¿Cómo le pareció la atención del NAF?</p>
                                        <div class="radio">
                                          <label><input type="radio" value="4" name="preg2">Muy buena</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="3" name="preg2">Buena</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="2" name="preg2">Regular</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg2">Mala</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 divPreg3 divpreg">
                                        <p>3. ¿Fueron logrados los objetivos de su consulta?</p>
                                        <div class="radio">
                                          <label><input type="radio" value="4" name="preg3">Muy bien</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="3" name="preg3">Bien</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="2" name="preg3">Suficiente</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg3">Insuficiente</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12 divPreg4 divpreg">
                                        <p>4. ¿Fue usted bien orientado en todos los procedimientos?</p>
                                        <div class="radio">
                                          <label><input type="radio" value="4" name="preg4">Muy bien</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="3" name="preg4">Bien</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="2" name="preg4">Suficiente</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg4">Insuficiente</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12 divPreg5 divpreg">
                                        <p>5. ¿Cómo se enteró de la existencia del NAF?</p>
                                        <div class="radio">
                                          <label><input type="radio" value="6" name="preg5">A través DIAN</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="5" name="preg5">Periódicos</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="4" name="preg5">Internet</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="3" name="preg5">Amigos</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="2" name="preg5">Universidad</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg5">Otro</label>
                                        </div>
                                        <div class="form-group otro" style="display:none;">
                                          <label for="cualotro">¿Cuál?</label>
                                          <input type="text" class="form-control" id="cualotro">
                                        </div>
                                    </div>

                                    <div class="col-md-12 divPreg6 divpreg">
                                        <p>6- ¿Recomendaría este servicio a otros ciudadanos? </p>
                                        <div class="radio">
                                          <label><input type="radio" value="1" name="preg6">Sí</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" value="0" name="preg6">No</label>
                                        </div>
                                    </div>
                        
                                        <p>¡Gracias por su tiempo!</p>
                                    <div class="col-md-12" class="btngroup">
                                        <button class="btn btn-success" onclick="enviarEncuesta();">ENVIAR ENCUESTA</button>
                                    </div>
                                    <!-- </div> -->
            					</div>
                            </div>
                            <?php
                            // }else if($row["estado"] == 1){
                            ?>
                        
                                <div id="gracias" style="text-align:center; max-width:750px;margin: 0 auto;padding:10px;<?php if($row["estado"] == 1){ echo 'display:block;'; }else { echo 'display:none;'; } ?>">
                                    <h3>Muchas gracias por contestar la encuesta, tu opinión es muy importante para nosotros.</h3>
                                </div>

                            <?php
                            // }else{
                            //     echo 'Acceso prohibido';
                            // }
                        }

                    }
                ?>

                <!-- /. footer  -->
                <?php 
                	include 'component/footer.php' 
                ?>
                <!-- /. footer  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. Fin Pagina  -->
    </div>
    <!-- /. WRAPPER  -->

<div class="loading">
    
</div>
    
</body>

</html>


