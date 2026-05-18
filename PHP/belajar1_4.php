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
            <option value="kubus">kubus</option>
            <option value="balok">balok</option>
            <option value="limas">limas</option>
            <option value="tabung">tabung</option>
            <option value="bola">bola</option>
        </select>
        <br>
        <label for="operator2">Operasi2</label>
        <select name="operator2" required>
            <option value="volume">volume</option>
            <option value="luas">luas</option>
        </select>

        <br>

        <label for="">Number x</label><br>
        <input type="number x" name="angka1"><br>

        <label for="">Number Y</label><br>
        <input type="number Y" name="angka2"><br>

        <label for="">Number T</label><br>
        <input type="number T" name="angka3"><br>

        <button type="submit" name="tampil">
            Tampilkan Data
        </button>

    </form>

    <?php
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['tampil'])) {
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $alamat = $_POST['alamat'];
        $operator = $_POST["operator"] ?? "tambah";
        $operator2 = $_POST["operator2"] ?? "tambah";
        $x = floatval($_POST['angka1'] ?? 0);
        $y = floatval($_POST['angka2'] ?? 0);
        $t = floatval($_POST['angka3'] ?? 0);
        function calculator($x = 1, $y = 1, $t = 0, $operator = 'kubus', $operator2 = 'luas')
        {
            switch ($operator) {

                case 'kubus':
                    if ($operator2 == 'luas') {
                        return (pow($x, 2)) * 6;
                    } elseif ($operator2 == 'volume') {
                        return pow($x, 3);
                    } else {
                        return "Invalid";
                    }

                case 'balok':
                    if ($operator2 == 'volume') {
                        return $x * $y * $t;
                    } elseif ($operator2 == 'luas') {
                        return 2 * ($x * $y + $x * $t + $y * $t);
                    } else {
                        return "Invalid";
                    }

                case 'limas':
                    if ($operator2 == 'volume') {
                        return (1 / 3) * (pow($x, 2)) * $t;
                    } elseif ($operator2 == 'luas') {
                        return 2 * ($x * $y + $x * $t + $y * $t);
                    } else {
                        return "Invalid";
                    }

                case 'tabung':
                    if ($operator2 == 'volume') {
                        return M_PI * (pow($x, 2)) * $t;
                    } elseif ($operator2 == 'luas') {
                        return 2 * M_PI * $x * ($x + $t);
                    } else {
                        return "Invalid";
                    }

                case 'bola':
                    if ($operator2 == 'volume') {
                        return (4 / 3) * M_PI * (pow($x, 3));
                    } elseif ($operator2 == 'luas') {
                        return 4 * M_PI * (pow($x, 2));
                    } else {
                        return "Invalid";
                    }

                default:
                    return "Invalid operator";
            }
        }
        // $hasilHitung = calculator($x, $y, $operator,);
        $calculate = calculator($x, $y, $t, $operator, $operator2);
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
        echo "Hasil Hitung: $operator2 $operator dengan $x $y = $calculate\n";
        echo "</textarea>";
    }

    ?>

</body>

</html>