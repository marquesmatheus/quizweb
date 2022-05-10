<?php 

/* Calculation trás a regra para os cálculos das questões, no caso tem q ser alterado no incorrect o valor fixo das quantidades de acordo com o que tiver no limit do header */
    include 'database/connection.php';
    error_reporting(0);
    session_start();
    //$turma = mysqli_real_escape_string($conn, $_POST['teste']);

    $email = $_SESSION['user'];
    $total = "SELECT count(*) FROM questions where turma in (select turma from user where email = '$email')";
    //$total = 0;
    $points = "SELECT count(*) FROM questions where turma in (select turma from user where email = '$email')";
    $correct = 0;
    $incorrect = 0;
 
    //$sql = "SELECT * FROM questions";
    $sql = "SELECT * FROM questions where turma in (select turma from user where email = '$email') and categoria in (select categoria from user where email = '$email')";
    $result = mysqli_query($conn, $sql);
    $record = array();
    $submitted = array();
    while($row = mysqli_fetch_assoc($result)){
          $record[] = $row;
      }
    
    if(isset($_POST['round1'])){
        foreach($record as $rec){
            $submitted = $_POST[$rec['Id']];
            $answer = $rec['Answer'];
            $question = $rec['question_rel'];

            if($submitted == $rec['Answer']){

$sql3 = "INSERT INTO history (email, question, answer, acertou, turma, categoria, data) values ('$email', '$question', '$answer', 'Sim',(select turma from user where email = '$email'),(select categoria from user where email = '$email'), now())";
                $sql99 = "UPDATE history SET id ='$id', acertou = 'Sim', question = '$question', answer = '$answer' where email = '$email'  ";
                $result3 = mysqli_query($conn, $sql3);
                $correct += 1;

            }else{          

$sqlerro = "INSERT INTO history (email, question, answer, acertou, turma, categoria, data) values ('$email', '$question', '$submitted' , 'Nao', (select turma from user where email = '$email'), (select categoria from user where email = '$email'), now())";
                $result4 = mysqli_query($conn, $sqlerro);
                //$incorrect += 1;                
                //$incorrect = $incorrect;
                
            }
        }
            // cada vez que somar 1 incorrect preciso arranjar uma maneira de limitar estes em 10.
                 
        $incorrect = 10 - $correct;
        $points = $correct*1;

        
        $sql = "UPDATE user SET Correct = '$correct', Wrong = '$incorrect', Points = '$points', nota = ('$points'/10) WHERE Email = '$email' ";
        $result = mysqli_query($conn, $sql);

    }
    echo "<script> location.href='testend/index.php'; </script>";
?>