<?php
include '../includes/connection.php';
require '../vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
  if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
      $fileName = $_FILES['file']['tmp_name'];
      $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      try {
          // Load file using PhpSpreadsheet
          $spreadsheet = IOFactory::load($fileName);
          $sheet = $spreadsheet->getActiveSheet();
          $rows = $sheet->toArray();

          // Skip the first row if it contains headers
          unset($rows[0]);

          // Loop through rows and insert into the database
          foreach ($rows as $row) {
              $category_name = $row[0];
              $category_code = $row[1];
              
            
              $sql = "INSERT INTO categorys (CNAME, CATEGORY_ID) 
                      VALUES (?, ?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ss", $category_name, $category_code);
              $stmt->execute();
          }

          echo "Data imported successfully!";
      } catch (Exception $e) {
          echo "Error loading file: " . $e->getMessage();
      }
  } else {
      echo "Please upload a file.";
  }
}

$conn->close();
?>