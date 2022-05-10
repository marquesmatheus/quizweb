<?php
$target_dir = "../login/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo " Arquivo é uma imagem - " . $check["mime"] . ". ";
        $uploadOk = 1;
    } else {
        echo " Arquivo não é uma imagem!";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo " Desculpe, arquivo com nome existente!. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo " Arquivo maior que 5 MB. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo " Mals ae! Somente arquivos JPG, JPEG, PNG & GIF. ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo " Perdão, arquivo não enviado!. ";
    echo '<a href="index.php" class="btn btn-default">Voltar</a>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "O arquivo ". basename( $_FILES["fileToUpload"]["name"]). " subiu para a pasta corretamente!. ";
        echo '<a href="index.php" class="btn btn-default">Voltar</a>';
    } else {
        echo " Perdão, Ocorreu um erro ao tentar subir teu arquivo!. ";
        echo '<a href="index.php" class="btn btn-default">Voltar</a>';
    }
}
?>