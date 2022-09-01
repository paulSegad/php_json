<?php 

//récupère le contenu du fichier
$file = file_get_contents("myfile.json");

// utiliser true dans le json_decode pour faire un tableau
$array = json_decode($file, true);

$id = '1';
$new_array = [];
foreach ($array as  $value) {
    if ($value['id'] != $id) {
        
        $new_one_array = ['id'=> $value['id'], 'name'=> $value['name'], 'designation'=> $value['designation']];
        array_push($new_array, $value);
    }
}
var_dump($new_array);
/*
$json = json_encode($new_array);
$new_file = fopen("myfile.json", "w");
fwrite($new_file, $json);
fclose($new_file);*/




?>