<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
require 'auth_functions.php';

checkAccess('Admin'); 
?>
<?php
$date = date('d-m-Y');
$query = 'SELECT *
                     FROM expense
                     WHERE expense_id ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            $data = mysqli_fetch_array($result);

?>
            <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group row text-left mb-0">

                <div class="col-sm-9">
		              <h5 class="font-weight-bold text-center">
                    ሰላምአርጊው ሃይፐር ማርኬት ኃላ/የተ/የግ/ማህበር
                  </h5>
                  <h5 class="font-weight-bold text-center">
                    የወጪ መጠየቂያ ቅጽ
                  </h5>
                </div>
                <div class="col-sm-3 py-1">
                  <h6>
                  ቀን: <?php echo $date; ?> ዓ.ም
                  </h6>
                </div>
              </div>
<hr>
                <div>
	              <h6 class="font-weight-bold">
                  የጠያቂው ስም : <?php echo $data['requested_by']; ?>
                  </h6>
                </div>
                <div>
                  <h6 class="font-weight-bold">
                  የተጠየቀው የገንዘብ መጠን :
                  </h6>
                  <h6 class="font-weight-bold">
                  በአሃዝ : <?php echo $data['amount']; ?>
                  </h6>
                  <h6 class="font-weight-bold">
                  በፊደል : 
                  </h6>
                </div>
                <div>
                  <h6 class="font-weight-bold">
                  የተጠየቀበት ምክንያት:  <?php echo $data['description']; ?>
                  </h6>
                </div>
              </div>
  <div style="padding: 40px;">
      <p>የጠያቂው ፊርማ-----------------------</p> 					
<p>የሥራ አስኪያጅ ስም （ፈቃጅ）ስም--------------------------------------  ፊርማ-------------------	</p>
      <p>የፈቃጅ አስተያት----------------------------------------------------------------------------</p>
<p>የቦርድ ሰብሳቢ （አጽዳቂ）ስም-----------------------------------------  ፊርማ-------------------</p> 
<p>አጽዳቂ አስተያት----------------------------------------------------------------------------------------------</p>
<p>የሂሳብ ክፍል ኃላፊ ቋሚ (ፈራሚ) ስም------------------------------------   ፊርማ-------------------</p>
<p>የቦርድ ም/ ሰብሳቢ  ስም---------------------------------------------   ፊርማ-------------------</p>


              <h3>ማስታወሻ:-</h3>
              <ol>
                <li>በቼክ ለወሰዱት ገንዘብ በ አንድ ወር ጊዜ ውስጥ መወራረድ ይኖርበታል።</li>
                <li>በጥቃቅን ወጭ ከተከፈለ በ አራት ቀን ጊዜ ውስጥ መወራረድ ይኖርበታል።</li>
              </ol>
      </div>
          

<?php
include'../includes/footer2.php';
?>