<?php 
    require '../database/connection.php';
    session_start();
    error_reporting(0);
?>
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
        <div class="container">
            <h2 style="margin-top:6%; text-align:center">Notas por Turma</h2><br>
            <p>
              
                <div>
            <?php 
              header("Content-type: text/html; charset=utf-8");
                include '../database/connection.php';
                  echo '<form method = "POST">';
                  if(!$conn){
                      echo 'Problem in Connection file.';
                  }

                  $result = mysqli_query($conn, "select nome from turmas where nome in (select distinct turma from user)");
                  echo"<center>";
                  echo"<select id = 'turmas' name = 'teste'>";
                  echo"<option>Escolha uma Turma</option>";
                  while($row=mysqli_fetch_array($result))
                  {
                    echo "<option id = 'turma'>$row[nome]</option>";
                  }
                  echo"<select>";
                  echo"</select>";
                  echo"</center>"
            ?> 
             <?php 
              header("Content-type: text/html; charset=utf-8");
                include '../database/connection.php';
                  if(!$conn){
                      echo 'Problem in Connection file.';
                  }

                  $result = mysqli_query($conn, "select distinct categoria from questions where turma in (select turma from questions)");
                  echo"<center>";
                  echo"<select id='categorias' name = 'categoria'>";
                  echo"<option>Escolha uma Categoria</option>";
                  while($row=mysqli_fetch_array($result))
                  {
                    echo "<option id = 'turma'>$row[categoria]</option>";
                    
                  }
                  echo"<select>";
                  echo"</select>";
                  echo"</center>";
           ?>
            <button id="pesquisar" class="login100-form-btn" type='submit' name='pesquisa'>
              Pesquisar Turma!
            </button>
            <button id="print" onClick="window.print()">Imprimir</button>
                          <style>
                                      @media print {
                                        #print {
                                          display: none;
                                        }
                                        #pesquisar {
                                          display: none;
                                        }#turmas {
                                          display: none;
                                        }#categorias {
                                          display: none;
                                     }
                          </style>
            </div>
            </p>            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Corretas</th>
                        <th>Pontos</th>
                        <th>Turmas</th>
                        <th>Categoria</th>
                        <th>Nota</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
    <?php

       if(isset($_POST['pesquisa']))
                  {
                     $mysqli = new mysqli('localhost','user','passwd','db_name');
                     $mysqli->set_charset("utf8");
                     
                    if ($mysqli -> connect_errno) {
                      echo 'deu zica';
                      exit();
                    }
                       $getvalor = $_POST['teste'];
                       $getvalor2 = $_POST['categoria'];
                       $sql = "SELECT * FROM user where turma ='$getvalor' and categoria = '$getvalor2' ORDER BY email";
                       $qtde = mysqli_query($conn, "SELECT count(*) as total FROM questions where turma ='$getvalor' and categoria = '$getvalor2' ORDER BY question DESC");
                       //$qtdetotal = mysqli_fetch_assoc($qtde); 
                       $result = $mysqli -> query($sql);
                       $i = 1;
                          if ($qtde = 0 ) {
                            echo "Nenhum Aluno respondeu por enquanto";
                          }
                          else
                          {
                            while($row = $result->fetch_assoc()){ 
                                    $email = $row['Email'];
                                    $correct = $row['Correct'];
                                    $points = $row['Points'];
                                    $turma = $row['turma'];
                                    $cat = $row['categoria'];
                                    $nota = $row['nota'];
                                    $data = $row['data_teste'];
                                  
                          
    ?>
                    <tr>    
                        <td><?php echo $email; ?></td>
                        <td><?php echo $correct; ?></td>
                        <td><?php echo $points; ?></td>
                        <td><?php echo $turma; ?></td>
                        <td><?php echo $cat; ?></td>
                        <td><?php echo $nota; ?></td>
                        <td><?php echo $data; ?></td>
                    </tr>                                
    <?php   
                $i++; 
                }
                 echo "<div>";
                 echo "<center><h4>Turma: ".$getvalor."  Categoria: ".$getvalor2."</h4><center>";
                echo "<center><h5>Total de Questões: 10 </h5></center>";
                echo "</div>";
               }
             }
    ?>       
                </tbody>
            </table>
        </div>
</body>
</html>