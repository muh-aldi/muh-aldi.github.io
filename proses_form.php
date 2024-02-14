<?php
// proses_form.php

// Koneksi ke database MySQL
$koneksi = mysqli_connect("localhost", "root", "", "contact_form_db");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah data telah dikirim
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        // Ambil nilai dari form dan escape karakter khusus
        $name = mysqli_real_escape_string($koneksi, $_POST['name']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $subject = mysqli_real_escape_string($koneksi, $_POST['subject']);
        $message = mysqli_real_escape_string($koneksi, $_POST['message']);

        // Query untuk menyimpan data ke dalam tabel
        $query = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Message successfully sent');</script>";
        } else {
            echo "<script>alert('Failed to sent the message, try again later');</script>";
        }

        // Tutup koneksi ke database
        mysqli_close($koneksi);

        // Kembalikan ke index.html setelah selesai
        echo "<script>window.location.href = 'index.html';</script>";
    } else {
        // Jika data tidak lengkap, tampilkan pesan kesalahan dan kembali ke index.html
        echo "<script>alert('Form data is not complete');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }
} else {
    // Jika halaman ini diakses langsung, tampilkan pesan kesalahan dan kembali ke index.html
    echo "<script>alert('Invalid request');</script>";
    echo "<script>window.location.href = 'index.html';</script>";
}
?>
