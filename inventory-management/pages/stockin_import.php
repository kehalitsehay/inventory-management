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
              $transac_id = $row[0];
              $product_code = $row[1];
              $product_name = $row[2];
              $category_name = $row[3];
              $quantity = $row[4];
              $unit = $row[5];
              $purchase_price = $row[6];
              $subtotal = $row[7];
              $vat = $row[8];
              $total = $row[9];
              $status = $row[10];
              $stockin_date = $row[11];
              $expire_date = $row[12];
              $employee = $row[13];
              $company_name = $row[14];
            
              $sql = "INSERT INTO stockin  
                      VALUES (NULL, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?,?, ?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ssssisddddsssss", $transac_id, $product_code, $product_name, $category_name, $quantity, $unit, $purchase_price, $subtotal, $vat, $total, $status, $stockin_date, $expire_date, $employee, $company_name);
              $stmt->execute();
          }

          echo "Stockin Data imported successfully!";
      } catch (Exception $e) {
          echo "Error loading file: " . $e->getMessage();
      }
  } else {
      echo "Please upload a file.";
  }
}

$conn->close();
?>