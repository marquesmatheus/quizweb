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
            <h2 style="margin-top:6%; text-align:center"></h2><br>
            <p>
              <div>
            <?php 
              header("Content-type: text/html; charset=utf-8");
                include '../database/connection.php';
                  echo '<form method = "POST">';
                  if(!$conn){
                      echo 'Problem in Connection file.';
                  }

                  $result = mysqli_query($conn, "select email from user where turma in (select turma from turmas) order by email asc");
                  echo"<center>";
                  echo"<select id = 'turmas' name = 'teste'>";
                  echo"<option>Escolha um E-mail</option>";
                  while($row=mysqli_fetch_array($result))
                  {
                    echo "<option id = 'turma'>$row[email]</option>";
                  }
                  echo"<select>";
                  echo"</select>";
                  echo"</center>"
            ?> 

            <button id ="print" class="login100-form-btn" type='submit' name='pesquisa'>
              Pesquisar Aluno!
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
                                        } 
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
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
    <?php

       if(isset($_POST['pesquisa']))
                  {
                       $getvalor = $_POST['teste'];
                       $resultado = mysqli_query($conn, "SELECT * FROM user where email ='$getvalor' ORDER BY Points DESC");
                       $turma = mysqli_query($conn, "SELECT turma from user where email ='$getvalor'");
                       $turmaaluno = mysqli_fetch_assoc($turma);
                       $qtde = mysqli_query($conn, "SELECT count(*) as total FROM history where email ='$getvalor'");
                       $qtdetotal = mysqli_fetch_assoc($qtde); 
                       $acertos = mysqli_query($conn, "SELECT count(*) as certas FROM history where acertou ='Sim' and email ='$getvalor'");
                       $acertadas = mysqli_fetch_assoc($acertos); 
                       $erros = mysqli_query($conn, "SELECT count(*) as erros FROM history where acertou ='Nao' and email ='$getvalor'");
                       $erradas = mysqli_fetch_assoc($erros); 
                       $record = array();
                          if ($qtde = 0 ) {
                            echo "Nenhum Aluno respondeu por enquanto";
                          }
                          else
                          {
                               while($row = mysqli_fetch_assoc($resultado))
                               {
                                  $record[] = $row;
                               }                 
                                    foreach($record as $rec){
                                    $email = $rec['Email'];
                                    $correct = $rec['Correct'];
                                    $points = $rec['Points'];
                                    $turma = $rec['turma'];
                                    $data = $rec['data_teste'];                                                          
    ?>
                   <tr>    
                        <td><?php echo $email; ?></td>
                        <td><?php echo $correct; ?></td>
                        <td><?php echo $points; ?></td>
                        <td><?php echo $turma; ?></td>
                        <td><?php echo $data; ?></td>
                    </tr>                       
    <?php   
                }          
                echo "<div>";
                echo "<center><h4>Turma: ".$turmaaluno['turma']."</h4><center>";
                echo "<center><h4>Email: ".$getvalor."</h4><center>";
                echo "<center><h5>Corretas:  ".$acertadas['certas']."  Erradas:  ".$erradas['erros']."  Total de: ".$qtdetotal['total']."</h5></center>";
                echo "</div>";
              } 
            }
    ?>       
                </tbody>
            </table>
        </div>
</body>
</html>