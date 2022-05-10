<?php
    session_start();
    include '../database/connection.php';

    if(isset($_POST['starttest'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $turma = mysqli_real_escape_string($conn, $_POST['teste']);
        $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
        // $time = date("h:i:sa");
        if($pass == 'colocar_token_aqui'){
            $_SESSION['user'] = $email;
            $sql = "SELECT * FROM user WHERE Email = '$email' and categoria = '$categoria'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if(!$rows){
                $sql = "INSERT INTO user (Email, Correct, Wrong, Points, turma, categoria, data_teste) VALUES ('$email','0', '0', '0', '$turma','$categoria', now())";
                $result = mysqli_query($conn, $sql);

            //$sql2 = "INSERT INTO history (email, question, answer, acertou, turma, data) VALUES ('$email','','','','$turma', now())";
               // $result2 = mysqli_query($conn, $sql2);
                header('refresh:2; url=../question.php');
                exit();
            }else{
             echo "<center><h1>Teste feito para este email! </h1></center>";
             echo "<center><h2><a href=\"https://facic.profdata.com.br/quiz/testend/leaderboard.php\">Veja o Ranking!!!</a></h2><center>";
            }
            
        }else{
           echo "<center><h1>Senha errada!. Clique em 'Tente novamente' para voltar!...</h1></center>";
           echo "<center><h2><a href=\"javascript:history.go(-1)\">Tente Novamente!!!</a></h2><center>";
        }
    }
?>