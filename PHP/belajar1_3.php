<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['tampil'])) {

    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $alamat = $_POST['alamat'];
    $operator = $_POST["operator"] ?? "tambah";
    $x = floatval($_POST['angka1'] ?? 0);
    $y = floatval($_POST['angka2'] ?? 0);
    function calculator($x, $y, $operator)
    {
        switch ($operator) {

            case '+':
                return $x + $y;

            case '-':
                return $x - $y;

            case '*':
                return $x * $y;

            case '/':
                return $y != 0
                    ? $x / $y
                    : "Cannot divide by zero";

            default:
                return "Invalid operator";
        }
    }

    $hasilHitung = calculator($x, $y, $operator);

    echo "<br><h3>Hasil Input:</h3>";
    echo "<textarea rows='9' cols='40' readonly>";
    echo "Nama: $name\n";
    echo "Nim: $nim\n";
    echo "Alamat: $alamat\n";
    //echo "Usia: $usia\n";
    //echo "Alamat: $alamat\n";
    //echo "Jenis Kelamin: $jenis_kelamin\n";
    //echo "Hobi: $hobi_str\n";
    //echo "Agama: $agama\n";
    echo "Hasil Hitung: $x $operator $y = $hasilHitung\n";
    echo "</textarea>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">

        <label for="">Nama</label><br>
        <input type="text" name="name"><br>

        <label for="">NIM</label><br>
        <input type="number" name="nim"><br>

        <label for="">Alamat</label><br>
        <textarea name="alamat" cols="30" rows="5"></textarea><br>

        <label for="operator">Operasi</label>
        <select name="operator" required>
            <option value="+">Tambah (+)</option>
            <option value="-">Kurang (-)</option>
            <option value="*">Kali (*)</option>
            <option value="/">Bagi (/)</option>
        </select>
        <br>
        <br>

        <label for="">Number</label><br>
        <input type="number" name="angka1"><br>

        <label for="">Number</label><br>
        <input type="number" name="angka2"><br>

        <button type="submit" name="tampil">
            Tampilkan Data
        </button>

    </form>


</body>

</html>