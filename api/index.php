<?php
    require_once 'orm/db.php';

    function get_apartments() {
        $list = R::findAll('apartments');
        $array = [];
        foreach ($list as $i) {
            array_push($array, [
                'id'=>$i['id'],
                'res_id'=>$i['res_id'],
                'name'=>$i['name'],
                'address'=>$i['address'],
                'price'=>$i['price'],
                'price_m'=>$i['price_m'],
                'square'=>$i['square'],
                'floor'=>$i['floor'],
                'year_of_completion'=>$i['year_of_completion'],
                'finishing'=>$i['finishing'],
                'text'=>$i['text'],
                'type_of_house'=>$i['type_of_house']
            ]);
        }
        return $array;
    }

    function apart_photos() {
        $list = R::findAll('apart_photos');
        $array = [];
        foreach ($list as $i) {
            array_push($array, [
                'id'=>$i['id'],
                'apart_id'=>$i['apart_id'],
                'file'=>$i['file']
            ]);
        }
        return $array;
    }

    function likes() {
        $list = R::findAll('likes');
        $array = [];
        foreach ($list as $i) {
            array_push($array, [
                'id'=>$i['id'],
                'u_id'=>$i['u_id'],
                'apart_id'=>$i['apart_id'],
            ]);
        }
        return $array;
    }

    function residential_complexes() {
        $list = R::findAll('residential_complexes');
        $array = [];
        foreach ($list as $i) {
            array_push($array, [
                'id'=>$i['id'],
                'name'=>$i['name'],
                'photo'=>$i['photo'],
                'deadline'=>$i['deadline'],
                'class'=>$i['class'],
                'floors'=>$i['floors'],
                'buildings'=>$i['buildings'],
                'type_of_house'=>$i['type_of_house'],
                'ceiling_height'=>$i['ceiling_height'],
                'finishing_options'=>$i['finishing_options'],
                'parking'=>$i['parking']
            ]);
        }
        return $array;
    }

    $array = [
        'apartments' => get_apartments(),
        'apart_photos' => apart_photos(),
        'likes' => likes(),
        'residential_complexes' => residential_complexes(),
    ];

    $json = json_encode($array, JSON_UNESCAPED_UNICODE);
    echo $json;