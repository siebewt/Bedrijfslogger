<?php 
setlocale(LC_TIME, 'nl_NL');

    $background = get_field('slide_weather_background');
    $background = 'style="background: url(' . $background['url'] . ')"';
?>

<div class="slide slide-weather"<?php dhwz_visibility(); ?><?php dhwz_duration(); ?><?= $background ?>>
    <?php
    $q = get_field('slide_weather_location');
    $appid = get_field('slide_weather_app_id');
    $url = 'https://api.openweathermap.org/data/2.5/forecast/daily?q=' . $q . '&units=metric&cnt=5&lang=nl&APPID=' . $appid;
    $data = json_decode(file_get_contents($url));
    ?>

    <div class="today-icon">
        <?php
        $path = ABSPATH . 'wp-content/themes/dhwz/slides/weather/img/' . $data->list[0]->weather[0]->icon . '.svg';
        echo file_get_contents($path);
        ?>
    </div>

    <div class="today-temp"><?= round($data->list[0]->temp->day); ?>&deg;</div>
    <div class="today-description"><?= ucfirst($data->list[0]->weather[0]->description); ?>. Met een minimumtemperatuur van <?= round($data->list[0]->temp->min); ?>&deg; en een maximumtemperatuur van <?= round($data->list[0]->temp->max); ?>&deg;. Vandaag wordt er een gemiddelde windsnelheid voorspeld van rond de <?= round($data->list[0]->speed); ?> kilometer per uur.</div>

    <?php
        $dayOffset = 1;
        $items = $data->list;
        unset($items[0]);
    ?>

    <div class="days">
        <?php foreach ($items as $item): ?>
            <div class="day">
                <?php
                $date = new DateTime();
                $date->modify('+' . $dayOffset . ' day');
                $date = $date->getTimestamp();
                $dayOffset++;

                ?>
                <div class="day-date"><?= strftime("%a", $date) ?></div>

                <div class="icon">
                    <?php $path = ABSPATH . 'wp-content/themes/dhwz/slides/weather/img/' . $item->weather[0]->icon . '.svg'; ?>
                    <?php echo file_get_contents($path); ?>
                </div>

                <div class="temp-max"><?php echo round($item->temp->max); ?>&deg;</div>
                <div class="temp-min"><?php echo round($item->temp->min); ?>&deg;</div>
                <div class="temp-min"><?php echo round($item->speed); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>