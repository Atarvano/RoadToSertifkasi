<?php


$select = ['a', 'b', 'c'];

$result = "";

// Ambil data dari hasil query dan bangun string secara manual
foreach ($select as $item) {
    if ($result !== "") {
        $result /.= ", "; // Tambahkan koma jika bukan elemen pertama
    }
    $result .= "'" . $item . "'"; // Tambahkan item dengan tanda kutip
}

echo $result;
?>