<?php
/**
 * Created by PhpStorm.
 * User: naashw
 * Date: 13/04/18
 * Time: 16:20
 */

namespace Controller;

use Model\CarManager;
use Model\car;

class carController extends AbstractController
{


    public function car()
    {
        session_start();
        $carManager = new CarManager();
        $car = $carManager->findAll();

        return $this->twig->render('Admin/ajouter.html.twig', ['car' => $car]);
    }

    public function addBdd()
    {
        var_dump($_FILES);
        $files = $_FILES['files'];
        $nbfichier = (array_count_values($files['error']));     //Compte le nombre de fichier qui n'a pas d'erreur.
        var_dump($nbfichier[0]);

        if ( $nbfichier[0] != 32 ) { //si les 32 fichier ont une erreur
            //erreur 4 => UPLOAD_ERR_NO_FILE, aucun fichier n'a été téléchargé
            $this->errors[] = 'Il faut sélectionner 32 photos.';
            $_SESSION['errors'][] = $this->errors;

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
                $file['upload_dir'] = "assets/images/" . 'image' . uniqid() . $extension;
                $uploadFiles[] = $file;
            }
            //cars sur les fichiers
            $i = 0;

            foreach ($uploadFiles as $uploadFile) {
                $i++;


                $error = false;
                if (($uploadFile['size'] > 10024000) || ($uploadFile['size'] < 100)) {
                    $this->errors[] = 'Le fichier ' . $file['name'] . ' est trop volumineux.';
                    $error = true;
                    $_SESSION['errors'][] = $this->errors;
                }
                if (!in_array($uploadFile['type'], ['image/gif', 'image/jpeg', 'image/png'])) {
                    $this->errors[] = 'Le type du fichier n\'est pas jpg, png ou gif.';
                    $error = true;
                    $_SESSION['errors'][] = $this->errors;
                }

                if ($error === false) { //Si il n'y a pas d'erreurs, faire le move, + intégré dans la bdd.
                    move_uploaded_file($uploadFile['tmp_name'], $uploadFile['upload_dir']);
                    $decks = "Decks2";
                    $carManager = new carManager();
                    $carManager->insert($decks, $uploadFile['upload_dir'], $i);
                }

            }
        }
        // header("location:/car");
    }
}