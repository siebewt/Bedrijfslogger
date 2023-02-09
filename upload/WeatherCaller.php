<link rel="stylesheet" href="../css/css.css">
<?php

class weather{
    public function getWeather(){
    $url = 'https://api.openweathermap.org/data/2.5/forecast/daily?q=Amsterdam&units=metric&cnt=1&lang=nl&APPID=8805930c35871b88b6dee16925c1ce05';
    $data = json_decode(file_get_contents($url));
    $items = $data->list;

    ?>
    <div class="day">
    <p>Weersverwachting: </p>
    <div class="days">
    <?php
    foreach($items as $item) {
        ?>
        <div class="temp"><?php echo round($item->temp->day); ?>&deg;</div>
        <?php
    }
    ?>
    </div>
    </div>
    <?php
}
}
// $weather = new weather();
// $api = $weather->getWeather();
?>