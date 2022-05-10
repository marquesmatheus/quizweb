<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
            margin-left: 20px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
                


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-16">

                    <form action="upload.php" method="post" enctype="multipart/form-data" style="align-items: center;">
                    Escolha a Imagem para Upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                    </form>

                    <div class="page-header clearfix">
                        <h2 class="pull-left">Questões - Detalhes</h2>
                        <a href="create.php" class="btn btn-success pull-right">Adicionar Nova Questão</a>
                    </div>

                    <?php
                    // Include config file
                    require_once "config.php";
                   
                   // Attempt select query execution
                    $sql = "SELECT distinct * FROM questions order by turma";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Questão</th>";
                                        echo "<th>Turma</th>";
                                        echo "<th>Categoria</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['Id'] . "</td>";
                                        echo "<td>" . $row['question_rel'] . "</td>";
                                        echo "<td>" . $row['turma'] . "</td>";
                                        echo "<td>" . $row['categoria'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='delete.php?id=". $row['Id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                                  
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Nenhuma questão encontrada.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>