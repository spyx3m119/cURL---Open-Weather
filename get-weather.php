<?php
$apiKey = "39459579d3cade1d6ccee63937249dcc";
$cityId = "1723064";
$units = 'metric'; // Celcius, imperial = F, empty is K

$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&time=UTC8&units=' . $units . '&APPID=" . $apiKey ;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response); //, true
$currentTime = time() ;
var_dump($currentTime);
$pretty_data = json_encode($data, JSON_PRETTY_PRINT);
//echo $pretty_data;
?>


<!doctype html>
<html>
<head>
<title>Forecast Weather using OpenWeatherMap with PHP</title>
<style>
body {
    font-family: Arial;
    font-size: 0.95em;
    color: #000;
}

.report-container {
    background-color: #2980b9;
    /*border: #c0392b 1px solid;*/
    padding: 20px 40px 40px 40px;
    border-radius: 2px;
    width: 550px;
    margin: 0 auto;
    color: #fff;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
    /*width: 80px;*/
    
}

.weather-forecast {
    display: inline-block;
    width:350px;
    float: right;
    color: #fff;
    font-size: 2.5em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
    color: #ccc;
    font-size: 1.5rem;
}

.time {
    line-height: 25px;
    width: 150px;
    display: inline-block;
   
}
.details {
    line-height: 25px;
    width: 100%;
    display: inline-block;
    text-align: right;
   
}

</style>

</head>
<body>
    <div class="report-container">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <hr/>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max;?> C<span
                class="min-temperature"><?php echo $data->main->temp_min;?> C</span>
        </div>
        <div class="details">
            <div>Humidity: <?php echo $data->main->humidity; ?> % | Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>
</html>
