<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Kalendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
  </head>
  <body>
    <?php
      $monthNames = Array("Jänner", "Februar", "März", "April", "Mai", "Juni", "Juli",
      "August", "September", "Oktober", "November", "Dezember");

      if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
      if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

      $cMonth = $_REQUEST["month"];
      $cYear = $_REQUEST["year"];

      $prev_year = $cYear;
      $next_year = $cYear;
      $prev_month = $cMonth-1;
      $next_month = $cMonth+1;

      if ($prev_month == 0 ) {
          $prev_month = 12;
          $prev_year = $cYear - 1;
      }
      if ($next_month == 13 ) {
          $next_month = 1;
          $next_year = $cYear + 1;
      }

    ?>
    <table style="width:245px;background-color: #eee;border: 1px solid #000;">
    <tr style="color:#FFFFFF;background-color:#f2afb9;text-align: center;">
      <td class="calender"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF"><</a></td>
      <td colspan="5"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
      <td class="calender"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">></a></td>
    </tr>
    <tr style="background-color:#888;">
      <td class="calender" style="color:#fff"><strong>Mo</strong></td>
      <td class="calender" style="color:#fff"><strong>Di</strong></td>
      <td class="calender" style="color:#fff"><strong>Mi</strong></td>
      <td class="calender" style="color:#fff"><strong>Do</strong></td>
      <td class="calender" style="color:#fff"><strong>Fr</strong></td>
      <td class="calender" style="color:#fff"><strong>Sa</strong></td>
      <td class="calender" style="color:#fff"><strong>So</strong></td>
    </tr>
    <?php

    $db = new PDO("mysql:host=nbsgames.at;dbname=MyNextEvent", "BF", "bachschwellfamily");
    $state = "SELECT YEAR(Datum) AS Year, MONTH(Datum) AS Month, DAY(Datum) AS Day FROM events;";
    $execute = $db->prepare($state);
    $execute->execute();

    $days = array();
    while (($result = $execute->fetch(PDO::FETCH_ASSOC)) != false){
      if($result["Year"] == $cYear && $result["Month"] == $cMonth){
        array_push($days, $result["Day"]);
      }
    }

    $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
    $maxday = date("t",$timestamp);
    $thismonth = getdate ($timestamp);
    $startday = $thismonth['wday'] - 1;
    if($startday == -1){
      $startday = 6;
    }
    //echo $startday;
    $skipper = 0;
    $show = false;
    if($cMonth == date("m", time()) && $cYear == date("Y", time())){
      $show = true;
    }

    for ($i=0; $i<($maxday+$startday); $i++) {
        if(($i % 7) == 0 ) echo "<tr>";
        if($i < $startday){
          ++$skipper;
          echo "<td class=\"calender\"></td>";
        }
        else if($show && date("d", time()) == ($i - $startday + 1)){
          echo "<td class=\"today\">". ($i - $startday + 1) . "</td>";
        }
        else if(in_array(($i - $startday + 1), $days)){
          echo "<td class=\"has-event\">". ($i - $startday + 1) . "</td>";
        }
        else echo "<td class=\"num\">". ($i - $startday + 1) . "</td>";
        if(($i % 7) == 6 ) echo "</tr>";
    }
    $filler = ($maxday % 7 + $skipper);

    if($filler > 7){
      $filler = 14 - $filler;
    }
    else if ($filler != 0){
      $filler = 7 - $filler;
    }
    
    for ($i=0; $i<$filler; $i++) {
      echo "<td class=\"calender\"></td>";
      if($i == ($filler-1)){
        echo "</tr>";
      }
    }
    ?>
    </table>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	
  <script src="/javascript/main.js"></script>
  </body>
</html>
