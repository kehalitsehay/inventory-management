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
              $category_id = $row[0];
              $product_code = $row[1];
              $product_name = $row[2];
              $category_name = $row[3];
              $unit = $row[4];
              $sales_price1 = $row[5];
              $sales_price2 = $row[6];
              $sales_price3 = $row[7];
            
              $sql = "INSERT INTO product (CATEGORY_ID, PRODUCT_CODE, NAME, CNAME, UNIT, sales_price1, sales_price2, sales_price3) 
                      VALUES (?, ?, ?, ?, ?,?, ?, ?)";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sssssddd", $category_id, $product_code, $product_name, $category_name, $unit, $sales_price1, $sales_price2, $sales_price3);
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