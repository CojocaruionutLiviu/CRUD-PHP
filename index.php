<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<?php require_once 'process.php'?>
<?php 

  if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
  </div>

<?php endif; ?>
<div class="container">
<?php 
  $mysqli = new mysqli('localhost', 'root', '','products') or die(mysqli_error($mysqli));
  $result =$mysqli->query ("SELECT * FROM products") or die($mysqli->error);
  // pre_r($result);
  // pre_r($result->fetch_assoc());
  // pre_r($result->fetch_assoc());
  ?>
  <div class="row justify-content-center">
  <table class="table">
    <thead>
      <tr>
        <th>Nume</th>
        <th>Descriere</th>
        <th>Pret</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['Nume']; ?></td>
        <td><?= $row['Descriere']; ?></td>
        <td><?= $row['Pret']; ?> $</td>
        <td>
          <a href="index.php?edit=<?= $row['id']; ?>"
            class="btn btn-info">Editeaza</a>
          <a href="process.php?delete=<?= $row['id']; ?>"
            class="btn btn-danger">Sterge</a>

        </td>
      </tr>
      <?php endwhile; ?>
  </table>
  </div>
  <?php
  function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
?>
  <div class="row justify-content-center">
    <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ; ?>">
      <div class="form-group">
        <label> Nume</label>
        <input type="text" name="Nume" class="form-control" placeholder="Numele produsului" value="<?php echo $nume; ?>">
      </div>
      <div class="form-group">
        <label>Descriere</label>
        <input type="text" name="Descriere" class="form-control" placeholder="Descrierea Produsului" value="<?php echo $descriere; ?>">
      </div>
      <div class="form-group">
        <label> Pret</label>
        <input type="number" name="Pret" class="form-control" placeholder="Pretul produsului" value="<?php echo $pret; ?>">
      </div>
      <div class="form-group">
      <?php 
      if($update == true) :
        ?>

        <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else : ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
      </div>
    </form>
  </div>
  </div>
</body>
</html>