<?php 
    require '../database/connection.php';
    session_start();
    error_reporting(0);
?>
      <!DOCTYPE html>
<html lang="en">
<head>
  <title>Resultados</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
        <div class="container">
            <h2 style="margin-top:6%; text-align:center">Gabarito por Aluno</h2><br>
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
                                        } #categorias {
                                          display: none;
                                     }
                          </style>
            </div>
            </p>            
            <table class="table table-hover">
                <thead align="left">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Questão</th>
                        <th>Resposta</th>
                        <th>Acertou?</th>
                        <th>Turma</th>
                        <th>Categoria</th>
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
                       $sql = "SELECT * FROM history where email ='$getvalor' and categoria = '$getvalor2' and answer <> '' order by acertou DESC";
                       $sql2 = mysqli_query($conn,"SELECT * FROM history where email ='$getvalor' and categoria = '$getvalor2' and answer <> '' ");
                       $turmas = mysqli_fetch_assoc($sql2); 
                       $qtde = mysqli_query($conn, "SELECT count(*) as total FROM history where email ='$getvalor' ORDER BY question DESC");
                       $qtdetotal = mysqli_fetch_assoc($qtde); 
                       $acertos = mysqli_query($conn, "SELECT count(*) as certas FROM history where acertou ='Sim' and email ='$getvalor'");
                       $acertadas = mysqli_fetch_assoc($acertos);
                       $erros = mysqli_query($conn, "SELECT count(*) as erros FROM history where acertou ='Nao' and email ='$getvalor' and categoria ='$getvalor2' and answer <> ''");
                       $erradas = mysqli_fetch_assoc($erros); 
                       $nota = mysqli_query($conn, "SELECT * from user where email = '$getvalor' and categoria = '$getvalor2'");
                       $notas = mysqli_fetch_assoc($nota);
                       $brancas = 10-($acertadas['certas']+$erradas['erros']);
                       
                        $result = $mysqli -> query($sql);
                        $i = 1;
                       
                          if ($qtde = 0 ) {
                            echo "Nenhum Aluno respondeu por enquanto";
                          }
                          else
                          {                                    
                               while($row = $result->fetch_assoc()){          
                                    $email = $row['email'];
                                    $quest = $row['question'];
                                    $resp = $row['answer'];
                                    $acerto = $row['acertou'];
                                    $turma = $row['turma'];
                                    $cat = $row['categoria'];
                                    $data = $row['data'];           
    ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $email; ?></td>                          
                          <td><?php echo $quest; ?></td>
                          <td><?php echo $resp; ?></td>
                          <td><?php echo $acerto; ?></td>
                          <td><?php echo $turma; ?></td>
                          <td><?php echo $cat; ?></td>
                          <td><?php echo $data; ?></td>
                        </tr>                                        
    <?php   
              $i++;  
              }
                
                echo "<div>";
                echo "<center><h4>Turma: ".$turmas['turma']."  Categoria: ".$turmas['categoria']."</h4><center>";
                echo "<center><h4>Email: ".$getvalor."</h4><center>";
                echo "<center><h5>Corretas:  ".$acertadas['certas']."  Erradas:  ".$erradas['erros']." Branco: ".$brancas."<h5></center>";
                echo "<center><h5>Total de:  ".$notas['Points']." ---- Nota:  ".$notas['nota']."<h5></center>";
                echo "<center><h5>Total de Questões: 10</h5></center>";
                echo "</div>";
              }              
            }            
    ?>       
                </tbody>
            </table>
        </div>
</body>
</html>