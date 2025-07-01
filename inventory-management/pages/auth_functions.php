<?php
function checkAccess($requiredRole) {
  if (!isset($_SESSION['TYPE']) || $_SESSION['TYPE'] !== $requiredRole) {
    ?>
    <script type="text/javascript">
      window.location = "unauthorized.php";
    </script>
    <?php   
    exit;  
  }
}