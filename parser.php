<?php
include_once('simple_html_dom.php');
include_once('curl_query.php');

    for ($i = 1; $i<9; $i++)
    {
        $main_link = 'http://www.bike.ua/kvadro/' . $i;

        $html = curl_get($main_link);
        $dom = str_get_html($html);

        $Links = $dom->find('.bike_pic');

        foreach ($Links as $oneLink)
        {
            $link = $oneLink->href;
            $html = curl_get($link);
            $dom = str_get_html($html);

            $brand_img = $dom->find('span.bike_brand img', 0);
            $brand_img_url = $brand_img->src;

            $name = $dom->find('.bike_title', 0)->plaintext;

            $img = $dom->find('div.bike_pic img', 0);
            $img_url = $img->src;
            $description = $dom->find('div.r p');
            $description = $description[1]->plaintext;

            $harakt = [];
            $bike_table = $dom->find('table.bike_table td');
            foreach ($bike_table as $td) {
                array_push($harakt, $td->plaintext);
            }
            $engine = $harakt[0];
            $transmission = $harakt[1];
            $revers = $harakt[2];
            $drive = $harakt[3];
            $block = $harakt[4];
            $back_suspension = $harakt[5];
            $brakes = $harakt[6];
            $tank = $harakt[7];
            $weight = $harakt[8];

            $pdf = PDF::loadView('myPDF2Onestep',
                [
                    'name' => $name,
                    'brand' => $brand_img_url,
                    'image' => $img_url,
                    'engine' => $engine,
                    'transmission' => $transmission,
                    'revers' => $revers,
                    'drive' => $drive,
                    'block' => $block,
                    'back_suspension' => $back_suspension,
                    'brakes' => $brakes,
                    'tank' => $tank,
                    'weight' => $weight,
                    'description' => $description,
                ]
            )->setWarnings(false)->save($name . '.pdf');

            echo "OK --- " . $name . '<br>';

        }
    }