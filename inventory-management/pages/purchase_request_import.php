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
              $PRODUCT_CODE = $row[0];
              $NAME = $row[1];
              $CATEGORY = $row[2];
              $QUANTITY = $row[3];
              $UNIT = $row[4];
              $DATE = $row[5];
              $STATUS = $row[6];
            
              $sql = "INSERT INTO purcase_req  
                      VALUES (NULL, ?, ?, ?, ?, ?,?, ?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sssssss", $PRODUCT_CODE, $NAME, $CATEGORY, $QUANTITY, $UNIT, $DATE, $STATUS);
              $stmt->execute();
          }

          echo "Purchase Request Data imported successfully!";
      } catch (Exception $e) {
          echo "Error loading file: " . $e->getMessage();
      }
  } else {
      echo "Please upload a file.";
  }
}

$conn->close();
?>