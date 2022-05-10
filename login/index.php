<?php
	session_start();
	session_unset();

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body style="background-color: #666666;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="user.php">
					<span class="login100-form-title p-b-43">
						<h1>Prof. Matheus  Exercícios</h1>
					</span>

					<div>
						<center><bold><h4>Escolha sua turma e categoria abaixo!</h4></bold></center></br>
					 <?php 
					 			include '../database/connection.php';
							    if(!$conn){
							        echo 'Problem in Connection file.';
							    }

							    $result = mysqli_query($conn, "select distinct nome from turmas where nome in (select turma from questions)");
							    echo"<center>";
							    echo"Turma:   ";
							    echo"<select name = 'teste'>";
							    while($row=mysqli_fetch_array($result))
							    {
							    	echo "<option id = 'turma'>$row[nome]</option>";
							    	
							    }
							    echo"<select>";
							    echo"</select>";
							    echo"</center>";
					 ?>	
					  <?php 
					 			include '../database/connection.php';
							    if(!$conn){
							        echo 'Problem in Connection file.';
							    }

							    $result = mysqli_query($conn, "select distinct categoria from questions where turma in (select turma from questions)");
							    echo"<center>";
							    echo"Categoria:   ";
							    echo"<select name = 'categoria'>";
							    while($row=mysqli_fetch_array($result))
							    {
							    	echo "<option id = 'turma'>$row[categoria]</option>";
							    	
							    }
							    echo"<select>";
							    echo"</select>";
							    echo"</center>";
					 ?>
					</div>
					
					<div class="wrap-input100 " data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">E-mail / Usuário</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Senha</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type='submit' name='starttest'>
							Começar Teste!
						</button>
					</div>
					
				</form>

				<div class="login100-more" style="background-image: url('images/prog.jpg'); align-content: center;">
				</div>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>