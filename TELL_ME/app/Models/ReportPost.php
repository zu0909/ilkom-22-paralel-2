<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "social_media";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['post_id']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $user_id = 1; // ID pengguna (contoh; gunakan ID yang valid dari sesi pengguna)

    // Simpan laporan ke database
    $sql = "INSERT INTO reports (post_id, user_id, reason) VALUES ('$post_id', '$user_id', '$reason')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Laporan berhasil dikirim.</p>";
    } else {
        echo "<p>Gagal menyimpan laporan: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
