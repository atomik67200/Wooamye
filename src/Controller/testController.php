<?php
/**
 * Created by PhpStorm.
 * User: naashw
 * Date: 13/04/18
 * Time: 16:20
 */

namespace Controller;

use Model\testManager;
use Model\test;

class testController extends AbstractController
{


    public function test1()
    {

      $testManager = new testManager();
      $test = $testManager->findAll();

        return $this->twig->render('test/test1.html.twig', ['test' => $test]);
    }

    public function addBdd()
      {
         $files = $_FILES['files'];
         if ($files['error'][0] === 4) {
             //erreur 4 => UPLOAD_ERR_NO_FILE, aucun fichier n'a été téléchargé
             $this->errors[] = 'Il faut sélectionner au moins 1 fichier.';
         } else {
             //traitement des fichiers
             $uploadFiles = [];
             for ($i = 0; $i < count($files['name']); $i++) {
                 $file = [];
                 $file['name'] = $files['name'][$i];
                 $file['type'] = $files['type'][$i];
                 $file['tmp_name'] = $files['tmp_name'][$i];
                 $file['error'] = $files['error'][$i];
                 $file['size'] = $files['size'][$i];
                 $infoName = pathinfo($file['name']);
                 $extension = '.' . $infoName['extension'];
                 $file['upload_dir'] = "assets/images/".'image'.uniqid().$extension;
                 $uploadFiles[] = $file;
             }
             //tests sur les fichiers
             $i = 0;
             var_dump($upluadFiles);
             foreach ($uploadFiles as $uploadFile) {
               var_dump($uploadFile['upload_dir']);
                $i++;
                $decks = "debase";
                  $testManager = new testManager();
                  $testManager->insert($decks, $uploadFile['upload_dir'], $i);
                $error = false;
                 if ($uploadFile['size'] > 10024000) {
                     $this->errors[] = 'Le fichier ' . $file['name'] . ' est trop volumineux.';
                     $error = true;
                 }
                 if (!in_array($uploadFile['type'], ['image/gif', 'image/jpeg', 'image/png'])) {
                     $this->errors[] = 'Le type du fichier n\'est pas jpg, png ou gif.';
                     $error = true;
                 }
                 if (!$error) {
                     move_uploaded_file($uploadFile['tmp_name'], $uploadFile['upload_dir']);
                 }
             }
         }
         header("location:/test");
       }
     }
