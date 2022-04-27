
<?php

include "database.php";

$dbslider1 = $connect->query("SELECT * from movies ORDER BY  RAND() LIMIT 1");
$dbslider2 = $connect->query("SELECT * from movies ORDER BY  RAND() LIMIT 1");
$dbslider3 = $connect->query("SELECT * from movies ORDER BY  RAND() LIMIT 1");
$dbslider4 = $connect->query("SELECT * from movies ORDER BY  RAND() LIMIT 1");
$dbslider5 = $connect->query("SELECT * from movies ORDER BY  RAND() LIMIT 1");




?>




<input type="radio" name="position" />
  <input type="radio" name="position" />
  <input type="radio" name="position" checked  />
  <input type="radio" name="position" />
  <input type="radio" name="position" />
  <?php

  
    
  ?>
  <main id="carousel">
    <div class="item"><img src="<?php while($veri = $dbslider1->fetch(PDO::FETCH_ASSOC))  {if($veri["movies_broadcasting"]==1){continue;}else{echo $veri['movies_image'];}}?>" style="height: 400px; width: 400px;" alt=""></div>
    <div class="item"><img src="<?php while($veri1 = $dbslider2->fetch(PDO::FETCH_ASSOC)) {if($veri1["movies_broadcasting"]==1){continue;}else{echo $veri1['movies_image'];}}?>" style="height: 400px; width: 400px;" alt=""></div>
    <div class="item"><img src="<?php while($veri2 = $dbslider3->fetch(PDO::FETCH_ASSOC)) {if($veri2["movies_broadcasting"]==1){continue;}else{echo $veri2['movies_image'];}}?>" style="height: 400px; width: 400px;" alt=""></div>
    <div class="item"><img src="<?php while($veri3 = $dbslider4->fetch(PDO::FETCH_ASSOC)) {if($veri3["movies_broadcasting"]==1){continue;}else{echo $veri3['movies_image'];}}?>" style="height: 400px; width: 400px;" alt=""></div>
    <div class="item"><img src="<?php while($veri4 = $dbslider5->fetch(PDO::FETCH_ASSOC)) {if($veri4["movies_broadcasting"]==1){continue;}else{echo $veri4['movies_image'];}}?>" style="height: 400px; width: 400px;" alt=""></div>
                        </main>


<?php ?>  