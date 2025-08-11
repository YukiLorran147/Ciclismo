<?php
session_start();
require_once "config.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
  $nome = trim($_POST["nome"]);
  $senha = trim($_POST["senha"]);

  $sql = "SELECT id, senha_hash FROM usuarios WHERE nome = ?";
  if($stmt = mysqli_prepare($conexao, $sql)){
    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) == 1){
      mysqli_stmt_bind_result($stmt, $id, $senha_hash);
      mysqli_stmt_fetch($stmt);
      if(password_verify($senha, $senha_hash)){
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        header("location: welcome.php");
        exit;
      } else {
        echo "Senha incorreta.";
      }
    } else {
      echo "Usuário não encontrado.";
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conexao);
}
?>
