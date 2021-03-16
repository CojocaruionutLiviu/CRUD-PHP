<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '','products') or die(mysqli_error($mysqli));
$id=0;
$update = false;
$nume= '';
$descriere = '';
$pret = '';

if (isset($_POST['save'])){
  $nume = $_POST['Nume'];
  $descriere = $_POST['Descriere'];
  $pret = $_POST['Pret'];

  $mysqli->query("INSERT INTO products (Nume, Descriere, Pret) VALUES ('$nume', '$descriere' , '$pret')") or die($mysqli->error);
  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "success";
  header("location: index.php");
}

if (isset($_GET['delete'])){
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM products WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";
  header("location: index.php");
}

if (isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update= true;
  $result = $mysqli->query("SELECT * FROM products WHERE id=$id") or die($mysqli->error);
  
  if ($result->num_rows == 1){
    $row = $result->fetch_array();
    $nume = $row['Nume'];
    $descriere = $row['Descriere'];
    $pret = $row['Pret'];
  }
}

if (isset($_POST['update'])){
  $id = $_POST['id'];
  $nume = $_POST['Nume'];
  $descriere = $_POST['Descriere'];
  $pret = $_POST['Pret'];
  $mysqli->query("UPDATE products SET Nume='$nume', Descriere='$descriere', Pret='$pret' WHERE id='$id'") or die($mysqli->error);
  $_SESSION['message'] = "Record has been updated!";
  $_SESSION['msg_type'] = "warning";
  header("location: index.php");
}