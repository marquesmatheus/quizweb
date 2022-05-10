<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$question = $opt1 = $opt2 = $opt3 = $opt4 = $answer = $turma = $categoria = "";
$question_err = $opt1_err = $opt2_err = $opt3_err = $opt4_err = $answer_err = $turma_err = $catego_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     // Validate question
    $input_question = trim($_POST["Question"]);
    if(empty($input_question)){
        $question_err = "Please enter an answer.";     
    } else{
        $question = $input_question;
    }

    $input_opt1 = trim($_POST["Option1"]);
    if(empty($input_opt1)){
        $opt1_err = "Please enter an answer.";     
    } else{
        $opt1 = $input_opt1;
    }
    
    $input_opt2 = trim($_POST["Option2"]);
    if(empty($input_opt2)){
        $opt2_err = "Please enter an answer.";     
    } else{
        $opt2 = $input_opt2;
    }
    
    $input_opt3 = trim($_POST["Option3"]);
    if(empty($input_opt3)){
        $opt3_err = "Please enter an answer.";     
    } else{
        $opt3 = $input_opt3;
    }
    
    $input_opt4 = trim($_POST["Option4"]);
    if(empty($input_opt4)){
        $opt4_err = "Please enter an answer.";     
    } else{
        $opt4 = $input_opt4;
    }
   
    // Validate answer
    $input_answer = trim($_POST["Answer"]);
    if(empty($input_answer)){
        $answer_err = "Please enter an answer.";     
    } else{
        $answer = $input_answer;
    }
     // Validate turma
    $input_turma = trim($_POST["turma"]);
    if(empty($input_turma)){
        $turma_err = "Please enter an answer.";     
    } else{
        $turma = $input_turma;
    }
     // Validate categoria
    $input_categoria = trim($_POST["categoria"]);
    if(empty($input_categoria)){
        $catego_err = "Please enter an answer.";     
    } else{
        $categoria = $input_categoria;
    }
      // Validate categoria
    $input_qr = trim($_POST["question_rel"]);
    if(empty($input_qr)){
        $questr_err = "Please enter an answer.";     
    } else{
        $questr = $input_qr;
    }

    // Check input errors before inserting in database
     if(empty($question_err) && empty($opt1_err) && empty($opt2_err) && empty($opt3_err) && empty($opt4_err) && empty($answer_err) && empty($turma_err) && empty($catego_err) && empty($questr_err)){
        // Prepare an insert statement
        $sql = "INSERT into questions (Question,Option1,Option2,Option3,Option4,Answer,turma,categoria,question_rel) VALUES (?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
           mysqli_stmt_bind_param($stmt, "sssssssss", $param_name,$param_opt1,$param_opt2,$param_opt3,$param_opt4,$param_answer,$param_turma,$param_catego,$param_questr);
            
            // Set parameters
            $param_name = $question;
            $param_answer = $answer;
            $param_turma = $turma;
            $param_opt1 = $opt1;
            $param_opt2 = $opt2;
            $param_opt3 = $opt3;
            $param_opt4 = $opt4;
            $param_catego = $categoria;
            $param_questr = $questr;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Inserir Questão</h2>
                    </div>
                    <p>Favor Preencher os campos!.</p>
                   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($question_err)) ? 'has-error' : ''; ?>">
                            <label>Questão - Colocar ao final caso tenha imagem: </br> img src="login/images/exer1.png" </br><img src="../login/images/imgquest.png"/></label>
                            <textarea name="Question"  class="form-control"><?php echo $question; ?></textarea>
                            <span class="help-block"><?php echo $question_err;?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($opt1_err)) ? 'has-error' : ''; ?>">
                            <label>Option 1</label>
                            <input type="text"  name="Option1"  class="form-control" value="<?php echo $opt1; ?>">
                            <span class="help-block"><?php echo $opt1_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($opt2_err)) ? 'has-error' : ''; ?>">
                            <label>Option 2</label>
                            <input type="text" name="Option2" class="form-control" value="<?php echo $opt2; ?>">
                            <span class="help-block"><?php echo $opt2_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($opt3_err)) ? 'has-error' : ''; ?>">
                            <label>Option 3</label>
                            <input type="text"  name="Option3" class="form-control" value="<?php echo $opt3; ?>">
                            <span class="help-block"><?php echo $opt3_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($opt4_err)) ? 'has-error' : ''; ?>">
                            <label>Option 4</label>
                            <input type="text" name="Option4"  class="form-control" value="<?php echo $opt4; ?>">
                            <span class="help-block"><?php echo $opt4_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($answer_err)) ? 'has-error' : ''; ?>">
                            <label>Resposta</label>
                            <textarea question="Answer" name="Answer"  class="form-control"><?php echo $answer; ?></textarea>
                            <span class="help-block"><?php echo $answer_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($turma_err)) ? 'has-error' : ''; ?>">
                            <label>Turma</label>
                            <input type="text"  name="turma" class="form-control" value="<?php echo $turma; ?>">
                            <span class="help-block"><?php echo $turma_err;?></span>
                        </div>

                          <div class="form-group <?php echo (!empty($catego_err)) ? 'has-error' : ''; ?>">
                            <label>Categoria</label>
                            <input type="text"  name="categoria" class="form-control" value="<?php echo $categoria; ?>">
                            <span class="help-block"><?php echo $catego_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($questr_err)) ? 'has-error' : ''; ?>">
                            <label>Questão Relatório - Colocar ao final caso tenha imagem: </br>img src="../login/images/exer1.png" </br><img src="../login/images/imgrel.png"</label>
                            <textarea name="question_rel"  class="form-control"><?php echo $questr; ?></textarea>
                            <span class="help-block"><?php echo $questr_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>