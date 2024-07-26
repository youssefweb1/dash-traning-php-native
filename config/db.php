<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "traning-ecommerce";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
      die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
  }

