<?php
//IF (isset($_GET['ad'])) {$additional=$_GET['ad'];}else {$additional="theatres/?token=c817837ff6fa7780ad8b2f5b64e73588&";}
IF (isset($_GET['cont'])) {$additional=$_GET['cont'].'/?token=c817837ff6fa7780ad8b2f5b64e73588';}else {$additional="theatres/?";}
IF (isset($_GET['id'])) {$additional.='&id='.$_GET['id'];}
IF (isset($_GET['jd'])) {$additional.='&date='.$_GET['jd'];}
//else{$additional.='&';}
IF (isset($_GET['kd'])) {$additional.='&free='.$_GET['kd'];}
//echo "http://localhost/PHP30/5/v1/".$additional;
$tt=file_get_contents("http://localhost/PHP30/5/v1/".$additional);

//var_dump($tt);
$tt=json_decode($tt,0);
//print_r($tt);
echo " <thead>";
foreach ($tt[0] as $key => $value) {
    echo '<th>'.$key . '</th>';
}
echo " </thead>";
foreach ($tt as $valu) {
    echo "<tr>";
    foreach ($valu as $key => $value) {
        echo '<td>' . $value . '</td>';
    }
    echo "</tr>";
}