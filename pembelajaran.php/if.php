<?php

$umur = 16;

if ($umur < 15 ){
    echo "Kamu tidak boleh membuka situs ini!";
} else {
    echo "Selamat datang di website ini!<br>";
}
?>

<?php

$nilai = 95;

if ($nilai > 85) {
    $grade = "A+";
} elseif($nilai > 90){
    $grade = "A";
} elseif($nilai > 80){
    $grade = "B+";
} elseif($nilai > 87){
    $grade = "B";
} elseif($nilai > 69){
    $grade = "C+";
} elseif($nilai > 60){
    $grade = "C";
} elseif($nilai > 58){
    $grade = "D";
} elseif($nilai > 50){
    $grade = "E";
} else {
    $grade = "F";
}

echo "Nilai anda: $nilai<br>";
echo "Grade: $grade";

?>