<?php 
/* Header que define a quantidade de questões que virão através do rand com o limit desejado, a mesma quantidade de linhas retornadas aqui tem q ser alteradas no incorrect
no arquivo calculation.php*/

 include 'database/connection.php';

   $email= $_SESSION['user'];
   
 $sql = "SELECT * FROM questions where turma in (select turma from user where email = '$email') and categoria in (select categoria from user where email = '$email') order by rand() limit 10";

 //$sql = "SELECT * FROM questions";

  $result = mysqli_query($conn, $sql);
  $record = array();
    while($row = mysqli_fetch_assoc($result)){
          $record[] = $row;
      }      
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Facic Teste</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="/testend/images/icons/favicon.ico"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  

<script>

var oldDateObj = new Date();
var countDownDate = new Date();
// O 120 DO MEIO QUE É A HORA ... NO CASO 120 / 2 = 60 MIN SÓ TROCAR O VALOR DO MEIO PARA ARRUMAR O TEMPO
countDownDate.setTime(oldDateObj.getTime() + (30 * 120 * 1000));
// Set the date we're counting down to
//var countDownDate = new Date("Jan 28, 2020 13:57:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "Tempo Restante: "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "<marquee>Tempo Esgotado!</marquee>";
    alert('Tempo esgotado! Teste será enviado.');
    document.getElementById("submitround1").click();
  }
}, 1000);
</script>
<style>
  #questions{
    -webkit-user-select: none; /* Safari 3.1+ */
    -moz-user-select: none; /* Firefox 2+ */
    -ms-user-select: none; /* IE 10+ */
    user-select: none;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" >
  <a class="navbar-brand" href="#"><?php echo $_SESSION['user']?></a>
  <a class="navbar-brand" id="demo" style='color:white;'></a>
  <!-- <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#"></a>
    </li>
  </ul> -->
</nav>

<div class="container mt-3" style='padding-top: 80px;'>
  <h2>Questionário</h2><br>
  <h4>Cada questão correta vale 1 ponto!</h4>
