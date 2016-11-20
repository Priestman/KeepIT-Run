<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>HW</title>

    <!-- Bootstrap core CSS -->
    <link href="frameworks/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .flex{
            display: flex;
            justify-content: center;
        }
        .flex_item{
            margin: 0 20px;
            padding: 5px 10px;
            text-align: center;
        }
    </style>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Health & Weather</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="speechKitTest.html">SpeechKit</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<?php

if (isset($_POST['ratio'])) { $ratio = $_POST['ratio']; if ($ratio == '') { unset($ratio);} }
$today = date("F j, Y, D");
$day = date("D");

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

$cloud = 'yasno';
$rain = 'no';

$yTemp = 12;
$yPres = 743;

//демо-данные

$find_temp = $arrayT[$Temp];
$find_pres = $arrayPres[$Pres];
$find_wind = $arrayWS[$Wind];
$find_hp = $arrayHP[$hp];

$find_cl = $arrayCloud[$cloud];
$find_r = $arrayRain[$rain];

$rez_difT_y = $Yesterday_dif[abs($yTemp - $Temp)];
$rez_difP_y = $Yesterday_dif_Pres[abs($yPres-$Pres)];

$rezult = $find_temp+$find_pres+$find_wind+$find_hp+$rez_difT_y+$rez_difP_y+$find_cl+$find_r;


$date_today = LibDateTime::current();
$result = [];
 
$result[] = '<div class="flex">';
for ($i = 0; $i < 7; $i++) {
    $result[] = '<div class="flex_item">';
    $result[] = '<a href="#">';
    $result[] = LibDateTime::weekday(LibDateTime::getDateAdd($date_today, 'P' . $i . 'D'));
    $result[] = '<br>';
    $result[] = LibDateTime::getDateName(LibDateTime::getDateAdd($date_today, 'P' . $i . 'D'));
    $result[] = '</a>';
    $result[] = '</div>';
}
$result[] = '</div>';
 
class LibDateTime
{
    const DATE_FORMAT_FULL = 'd.m.Y H:i:s';
    const DATE_FORMAT_SHORT = 'd.m.Y';
    const DATE_FORMAT_DIFF = '%r%a';
 
    private static $_weekday = [
        'а чёрт его знает',
        'Mon',
        'Tue',
        'Wed',
        'Thu',
        'Fri',
        'Sat',
        'Sun'
    ];
 
    private static $_month_name_r = [
        '',
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec',
    ];
 
    private static $_year_suffix = [
        '',
        'y.'
    ];
 
    public static function current($format = self::DATE_FORMAT_FULL)
    {
        $date = date($format);
 
        return self::formatDate($date);
    }
 
    public static function getDateAdd($date, $interval, $format = self::DATE_FORMAT_SHORT)
    {
        $d1 = new DateTime($date);
        $result = $d1->add(new DateInterval($interval))->format($format);
 
        return $result;
    }
 
    public static function formatDate($date = null, $format = self::DATE_FORMAT_SHORT)
    {
        if (is_null($date)) {
            $date = date(self::DATE_FORMAT_SHORT);
        }
 
        $date_obj = new DateTime($date);
 
        return $date_obj->format($format);
    }
 
    public static function weekday($date = null)
    {
        if (is_null($date)) {
            $date = date(self::DATE_FORMAT_SHORT);
        }
 
        return self::$_weekday[self::formatDate($date, 'N')];
    }
 
    public static function getDateName($date = null, $suffix = 0)
    {
        if (is_null($date)) {
            $date = date('d.m.Y');
        }
        $suffix = (int)$suffix;
        if ($suffix < 0 or $suffix > 3) {
            $suffix = 0;
        }
 
        $result[] = LibDateTime::formatDate($date, 'd');
        $result[] = self::$_month_name_r[LibDateTime::formatDate($date, 'n')];
        if ($suffix) {
            $result[] = LibDateTime::formatDate($date, 'Y');
            $result[] = self::$_year_suffix[$suffix];
        }
 
        return trim(implode(' ', $result));
    }
}

?>

  <div class="container">
     <div class="starter-template">
        <h1>The forecast being for a week</h1>
      </div>
      <div class="text-center">
        <h2>Now is</h2>
        <h3>
          <?php echo "$today";   
          ?>
        </h3>
            <p>
               <?php

if ($ratio == '1') {

  $K = round($rezult * 1);
      if (($K > 0) AND ($K <= 15)) { echo "<img src='img/feel_1.jpg'/>";} 
      elseif (($K > 15) AND ($K <= 23)) { echo "<img src='img/feel_2.jpg'/>";}
      elseif (($K > 23 ) AND ($K <= 30)) { echo "<img src='img/feel_3.jpg'/>";}
      elseif (($K > 30) AND ($K <= 35)) { echo "<img src='img/feel_4.jpg'/>";}
      elseif ($K > 35) { echo "<img src='img/feel_5.jpg'/>";} 
      
 }     

if ($ratio == '0.9') {

$K = round($rezult*0.9);
      if (($K > 0) AND ($K <= 15)) { echo "<img src='img/feel_1.jpg'/>";} 
      elseif (($K > 15) AND ($K <= 23)) { echo "<img src='img/feel_2.jpg'/>";}
      elseif (($K > 23 ) AND ($K <= 30)) { echo "<img src='img/feel_3.jpg'/>";}
      elseif (($K > 30) AND ($K <= 35)) { echo "<img src='img/feel_4.jpg'/>";}
      elseif ($K > 35) { echo "<img src='img/feel_5.jpg'/>";} 
}

if ($ratio == '0.8') {

$K = round($rezult*0.8);
      if (($K > 0) AND ($K <= 15)) { echo "<img src='img/feel_1.jpg'/>";} 
      elseif (($K > 15) AND ($K <= 23)) { echo "<img src='img/feel_2.jpg'/>";}
      elseif (($K > 23 ) AND ($K <= 30)) { echo "<img src='img/feel_3.jpg'/>";}
      elseif (($K > 30) AND ($K <= 35)) { echo "<img src='img/feel_4.jpg'/>";}
      elseif ($K > 35) { echo "<img src='img/feel_5.jpg'/>";} 
}

if ($ratio == '0.7') {

$K = round($rezult*0.7);
      if (($K > 0) AND ($K <= 15)) { echo "<img src='img/feel_1.jpg'/>";} 
      elseif (($K > 15) AND ($K <= 23)) { echo "<img src='img/feel_2.jpg'/>";}
      elseif (($K > 23 ) AND ($K <= 30)) { echo "<img src='img/feel_3.jpg'/>";}
      elseif (($K > 30) AND ($K <= 35)) { echo "<img src='img/feel_4.jpg'/>";}
      elseif ($K > 35) { echo "<img src='img/feel_5.jpg'/>";} 
}

          ?>

            </p>
              <div class="row"> 

                <?= implode($result) ?>

              </div>
        <div class="row">
          <h2>Recomendation</h2>
          <p>
            <?php

if ($ratio == '1') {

  $K = round($rezult * 1);

if (($K > 0) AND ($K <= 15)) { echo "Сегодня погода очень сильно повлияет на Вас. Будьте внимательны! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом >
  ПС. Рекомендуем перенести работу на дом, пить чай под пледом, гладить кота и смотреть хорошее кино. <br> ";} 
elseif (($K > 15) AND ($K <= 23)) { echo "Сегодня погода в достаточно сильной степени будет оказывать на вас воздействие. Будьте осоторожны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 23 ) AND ($K <= 30)) { echo "Средняя степень влияния погоды, просто будьте внимательны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 30) AND ($K <= 35)) { echo "Едва заметное влияние погоды, хороший день! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif ($K > 35) { echo "Сегодня погода совсем не ощущается. отличный день для новых начинаний и успешного продолжения начатых! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
      
 }     

if ($ratio == '0.9') {

if (($K > 0) AND ($K <= 15)) { echo "Сегодня погода очень сильно повлияет на Вас. Будьте внимательны! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом >
  ПС. Рекомендуем перенести работу на дом, пить чай под пледом, гладить кота и смотреть хорошее кино. <br> ";} 
elseif (($K > 15) AND ($K <= 23)) { echo "Сегодня погода в достаточно сильной степени будет оказывать на вас воздействие. Будьте осоторожны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 23 ) AND ($K <= 30)) { echo "Средняя степень влияния погоды, просто будьте внимательны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 30) AND ($K <= 35)) { echo "Едва заметное влияние погоды, хороший день! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif ($K > 35) { echo "Сегодня погода совсем не ощущается. отличный день для новых начинаний и успешного продолжения начатых! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
}

if ($ratio == '0.8') {

$K = round($rezult*0.8);
if (($K > 0) AND ($K <= 15)) { echo "Сегодня погода очень сильно повлияет на Вас. Будьте внимательны! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом >
  ПС. Рекомендуем перенести работу на дом, пить чай под пледом, гладить кота и смотреть хорошее кино. <br> ";} 
elseif (($K > 15) AND ($K <= 23)) { echo "Сегодня погода в достаточно сильной степени будет оказывать на вас воздействие. Будьте осоторожны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 23 ) AND ($K <= 30)) { echo "Средняя степень влияния погоды, просто будьте внимательны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 30) AND ($K <= 35)) { echo "Едва заметное влияние погоды, хороший день! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif ($K > 35) { echo "Сегодня погода совсем не ощущается. отличный день для новых начинаний и успешного продолжения начатых! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
}

if ($ratio == '0.7') {

if (($K > 0) AND ($K <= 15)) { echo "Сегодня погода очень сильно повлияет на Вас. Будьте внимательны! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом >
  ПС. Рекомендуем перенести работу на дом, пить чай под пледом, гладить кота и смотреть хорошее кино. <br> ";} 
elseif (($K > 15) AND ($K <= 23)) { echo "Сегодня погода в достаточно сильной степени будет оказывать на вас воздействие. Будьте осоторожны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 23 ) AND ($K <= 30)) { echo "Средняя степень влияния погоды, просто будьте внимательны. < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif (($K > 30) AND ($K <= 35)) { echo "Едва заметное влияние погоды, хороший день! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}
elseif ($K > 35) { echo "Сегодня погода совсем не ощущается. отличный день для новых начинаний и успешного продолжения начатых! < далее рекомендация в зависимости от индивидуальных факторов и целей, указанных пользователем, а также выводов, сделанных за период мониторинга состояния пользователя умным браслетом > <br>";}

}
          ?>
          </p>
        </div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="frameworks/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>