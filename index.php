<?php 
  
// data strored in array
/* Créer un fichier JSON
$array = Array (
    "0" => Array (
        "id" => "01",
        "name" => "Olivia Mason",
        "designation" => "System Architect"
    ),
    "1" => Array (
        "id" => "02",
        "name" => "Jennifer Laurence",
        "designation" => "Senior Programmer"
    ),
    "2" => Array (
        "id" => "03",
        "name" => "Medona Oliver",
        "designation" => "Office Manager"
    )
);

// encode array to json
$json = json_encode($array);
$file = fopen("myfile.json", 'w'); 
fwrite($file, $json);
fclose($file);
*/
//récupère le contenu du fichier
$file = file_get_contents("myfile.json");

// utiliser true dans le json_decode pour faire un tableau
$array = json_decode($file, true);

include 'index.html';


if (!empty($_POST)) {
    
    if (isset($_POST['method'])) {
        $new_array = [];
        foreach ($array as  $value) {
            if ($value['id'] != $_POST['id_to_delete']) {
                array_push($new_array, $value);
            }
        }

        $json = json_encode($new_array);
        $new_file = fopen("myfile.json", "w");
        fwrite($new_file, $json);
        fclose($new_file);

        header("Location: index.php");
        exit;
    }else {
    //Création du nouveau contenu
    
    //Récupération du nom
    $name = $_POST['name'];

    //Récupération de la designation
    $design = $_POST['designation'];

    //Récupération du dernier ID
    $last_value = end($array);
    $id_to_number = intval($last_value['id']);
    $new_id_number = $id_to_number + 1;
    $new_id = strval($new_id_number);

    //Création du tableau
    $new_array = ['id'=> $new_id, 'name'=> $name, 'designation'=> $design];
    
    //Update du tableau et création du JSON
    array_push($array, $new_array);
    $json = json_encode($array);
    
    //Remplacement du contenu json du file
    $new_file = fopen("myfile.json", "w");
    fwrite($new_file, $json);
    fclose($new_file);
    
    //Rechargement de la page
    header("Location: index.php");
    exit; }
}