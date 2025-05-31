<?php

// $mahasiswa =[
//     [
//         "nama" => "Naura Zavia",
//         "nrp" => "2217020073",
//         "email" => "naurazavia@gmail.com"
//     ],
//     [
//         "nama" => "Nalwira",
//         "nrp" => "2217020037",
//         "email" => "nalwirazalradavia@gmail.com"
//     ]
// ];

$dbh = new PDO('mysql:host=localhost;dbname=wpu_rest', 'root');
$db = $dbh->prepare('SELECT * FROM mahasiswa');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
$data = json_encode($mahasiswa);
echo $data;

?>