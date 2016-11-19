<?php

if (isset($_POST['ratio'])) { $ratio = $_POST['ratio']; if ($ratio == '') { unset($ratio);} }
$today = date("d.m.y");

// today weather: Temp = 10, pressure = 740, wind = 6, hp = 40
// Cloudness = yasno, rain = no

// today weather2: Temp = 20, pressure = 750, wind = 6, hp = 50
// Cloudness = pasmurno, rain = no

// yersterday weather: Temp = 25, pressure = 750, wind = 3, hp = 30
// Cloudness = yasno, rain = no

// yersterday weather2: Temp = 20, pressure = 750, wind = 6, hp = 60
// Cloudness = peremenno, rain = little

//массивы вариантов

$arrayT = array('-30' => 0, '-20' => 1, '-10' => 2, '0' => 3, '10' => 4, '20' => 5, '25' => 4, '30' => 3, '35' => 2, '40' => 1);
$arrayPres = array('720' => 1, '730' => 2, '740' => 3, '750' => 4, '760' => 5, '770' => 4, '780' => 3);
$arrayWS = array('0' => 5, '3' => 4, '6' => 3, '9' => 2, '12' => 1, '15' => 0);
$arrayHP = array('30' => 2, '40' => 3, '50' => 4, '60' => 5, '70' => 4, '80' => 3, '90' => 2, '100' => 1);

$arrayCloud = array('yasno' => 5, 'peremenno' => 3, 'pasmurno' => 1, 'rain' => 0);
$arrayRain = array('no' => 5, 'little' => 4, 'medium' => 3, 'many' => 2, 'aLotOf' => 1);

$Yesterday_dif = array('0' => 5, '2' => 4, '4' => 3, '6' => 2, '8' => 1, '10' => 0);
$Yesterday_dif_Pres = array('0' => 5, '3' => 4, '6' => 3, '9' => 2, '12' => 1, '15' => 0);

$array_all = range(10, 40);

//демо-данные

$Temp = 10;
$Pres = 740;
$Wind = 6;
$hp = 40;

$yTemp = 12;
$yPres = 743;

//демо-данные

$find_temp = $arrayT[$Temp];
$find_pres = $arrayPres[$Pres];
$find_wind = $arrayWS[$Wind];
$find_hp = $arrayHP[$hp];

$rez_difT_y = $Yesterday_dif[abs($yTemp - $Temp)];
$rez_difP_y = $Yesterday_dif_Pres[abs($yPres-$Pres)];

$rezult = $find_temp+$find_pres+$find_wind+$find_hp+$rez_difT_y+$rez_difP_y;

if ($ratio == '1') {

$K = round($rezult * 1);
echo "$K";
  } 

if ($ratio == '0.9') {

$K = round($rezult*0.9);
echo "$K";
}

if ($ratio == '0.8') {

$K = round($rezult*0.8);
echo "$K";
}

if ($ratio == '0.7') {

$K = round($rezult*0.7);
echo "$K";
}

?>