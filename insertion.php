<?php
header('Access-Control-Allow-Origin: *');
include("db.php");

$conversation = $_GET['conversation'];
$message = $_GET['message'];

   $connexion = new PDO($url, $user, $pass);
    // pour afficher les erreurs dans le catch
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    //On créer une requête sous forme de chaîne de caractère
    
    $rqt = "INSERT INTO messages (message, conversation, date_message, user_id) VALUES (:message, :conversation, NOW(), (select id from utilisateurs where email = :conversation))";
    //On prépare notre requête. ça nous renvoie un objet qui est notre requête préparée prête à être executée
    try {
        $statement = $connexion->prepare($rqt);
        $statement->bindParam(':conversation', $conversation);
        $statement->bindParam(':message', $message);
        //On l'execute
        $statement->execute();
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    
   //echo json_encode($results); 