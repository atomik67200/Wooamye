<?php


if(isset($_POST['submit'])){
  $uploads_dir = "assets/images/imgUploaded/";
  $taillemax = 9999999999999;
  $taille = $_FILES["carte"]["size"];
  $extensions = array('.png', '.gif', '.jpg');
  $extension = ($_FILES['carte']['name']);

  foreach ($_FILES["carte"]["tmp_name"] as $key => $tmp_name) {

    if ($taille[0] > $taillemax) {
      $erreur = "Votre fichier est trop gros...";
    }

    if(!in_array(strrchr($extension[0], '.'), $extensions)){
      $erreur = 'Vous devez uploader un fichier de type png, gif ou jpg...';
    }

    if (!isset($erreur)) {
      $tmp_name = $_FILES["carte"]["tmp_name"][$key];
      $name = uniqid('image');
      move_uploaded_file($tmp_name, "$uploads_dir/$name");

    }else{
      echo $erreur;
    }
  }
}

foreach ($_POST as $champs => $value) {
  if(substr($champs,0,6)=='delete')
  {
    unlink( 'assets/images/imgUploaded/'.$_POST['suppression'.substr($champs,-1)] );
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta charset="utf-8">
  <title>carte?</title>
</head>
<body>
  <form action="" enctype="multipart/form-data" method="post" class="text-center" style="margin-top:100px;">

    <div>
      <label for='carte'>Add Attachments:</label>
      <input id='carte' name="carte[]" type="file" multiple="multiple" />
    </div>

    <p><input type="submit" name="submit" value="Submit"></p>
    <div class="container">
      <div class="row">

        <?php
        $it = new FilesystemIterator(dirname("assets/images/imgUploaded/."));
        $i =0;
        foreach ($it as $fileinfo) {
          $i++;
          $filename = $fileinfo->getfilename();
          echo '<div class=col-6 thumbnail>';
          echo '<img src="'.$fileinfo.'" class="rounded" float="left" alt="$value" width="100%;">';
          echo $filename;
          echo "<p><input class='btn btn-danger' type='submit' name='delete$i' method='post' value='delete'/>";
          echo "<input type='hidden' name='suppression$i' value='$filename'>";
          echo '<hr>';
          echo '</div>';
        }

        ?>
      </div>
    </div>

  </form>
</body>
</html>
