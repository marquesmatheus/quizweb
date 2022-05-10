<?php 
    include '../database/connection.php';
    session_start();

	$sql = "SELECT * FROM user ORDER BY turma,correct DESC";
    $result = mysqli_query($conn, $sql);
	$record = array();
    
    while($row = mysqli_fetch_assoc($result)){
          $record[] = $row;
	  }?>
      <!DOCTYPE html>
<html lang="en">
<head>
  <title>Resultados</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<style>
  table {
  border-collapse: collapse;
  width: 100%;
 }

th, td {
  text-align: left;
  padding: 8px;
  font-family: verdana;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #008B8B;
  color: white;
}
</style>
        <div class="container">
            <h2 style="margin-top:6%; text-align:center; color: #000080; font-style: bold; font-size: 50px; font-family: verdana">RANKING</h2><br>
            <p>
            	
            	<form>
  					<input type="button" value="Voltar!" onclick="window.location.href = 'https://facic.profdata.com.br'">
				      </form>

            </p>            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Acertos</th>
                        <th>Pontos</th>
                        <th>Erros</th>
                        <th>Turma</th>
                        <th>Categoria</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
    <?php
	    foreach($record as $rec){
            $email = $rec['Email'];
            $correct = $rec['Correct'];
            $points = $rec['Points'];
            $incorrect = $rec['Wrong'];
            $turma = $rec['turma'];
            $cat = $rec['categoria'];
            $data = $rec['data_teste'];
    ?>
                    <tr>    
                        <td><?php echo $email; ?></td>
                        <td><?php echo $correct; ?></td>
                        <td><?php echo $points; ?></td>
                        <td><?php echo $incorrect; ?></td>
                        <td><?php echo $turma; ?></td>
                        <td><?php echo $cat; ?></td>
                        <td><?php echo $data; ?></td>
                    </tr> 
    <?php 
      }  
    ?>	      

                </tbody>
            </table>
        </div>
</body>
</html>