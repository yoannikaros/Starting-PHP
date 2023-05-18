<?php
session_start(); // Mulai session

// Hapus semua data session
session_unset();
session_destroy();

// Arahkan pengguna ke halaman login atau halaman lain yang sesuai
header("Location: ../auth/login");
exit();
