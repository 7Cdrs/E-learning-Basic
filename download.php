<?php
// Proses form jika nilai disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'library/config.php';
    include 'library/opendb.php';
    $mahasiswa_id = $_POST["mahasiswa_id"];
    $dosen_id = $_POST["dosen_id"];
    $nilai = $_POST["nilai"];

    // Masukkan data ke dalam tabel nilai
    $sql = "INSERT INTO nilai (mahasiswa_id, dosen_id, nilai) VALUES ('$mahasiswa_id', '$dosen_id', '$nilai')";

    if ($conn->query($sql) === TRUE) {
        echo "Data nilai berhasil dimasukkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    include 'library/closedb.php';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Download File From MySQL</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Download Files</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Download Link</th>
        </tr>
        <?php
        include 'library/config.php';
        include 'library/opendb.php';
        $query = "SELECT id, name, path FROM upload";
        $result = mysqli_query($conn, $query) or die('Error, query failed');
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='3'>Database is empty</td></tr>";
        } else {
            while (list($id, $name, $path) = mysqli_fetch_array($result)) {
        ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><a href="<?php echo $path; ?>">Download</a></td>
                </tr>
        <?php
            }
        }
        include 'library/closedb.php';
        ?>
    </table>

    <h2>Form Input Nilai Mahasiswa</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="mahasiswa_id">ID Mahasiswa:</label>
        <input type="text" id="mahasiswa_id" name="mahasiswa_id">

        <!-- Form input untuk ID Dosen bisa diganti sesuai kebutuhan -->
        <label for="dosen_id">ID Dosen:</label>
        <input type="text" id="dosen_id" name="dosen_id">

        <label for="nilai">Nilai:</label>
        <input type="number" id="nilai" name="nilai" min="0" max="100">

        <input type="submit" value="Submit">
    </form>
</body
