<?php

const email = "susi@gmail.com";
//const email = "budi@gmail.com";
echo email;

$fruits = array("apple", "mangga", "pisang");
$cars = ["Toyota", "Mazda", "Honda"];

echo "<br>";

array_push($fruits, "quldi", "anggur");

foreach ($fruits as $key => $fruit) {
    echo "Nama buah adalah $fruit <br>";
}

echo $fruits[2];

$motorcycles = [
    [
        'merek' => 'Honda',
        'warna' => 'merah',
        'tahun' => '2026',
        'cc' => 150
    ],
    [
        'merek' => 'kawasaki',
        'warna' => 'merah',
        'tahun' => '2026',
        'cc' => 250
    ],
    [
        'merek' => 'yamaha',
        'warna' => 'merah',
        'tahun' => '2026',
        'cc' => 250
    ]
];

foreach ($motorcycles as $index => $motorcycle) {
    if ($index != 2) {
        echo "<ul>
        <li>Nama Motor: {$motorcycle['merek']}</li>
        <li>Warna Motor: {$motorcycle['warna']}</li>
        <li>Tahun Motor: {$motorcycle['tahun']}</li>
        <li>cc Motor: {$motorcycle['cc']}</li>

    </ul>";
    }
}
