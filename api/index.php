<?php
    require_once '../orm/db.php';

    if ($_GET['data'] == 'pwa') {
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
                    'description'=>$i['description'],
                    'photo'=>$i['photo'],
                    'deadline'=>$i['deadline'],
                    'floors'=>$i['floors'],
                    'buildings'=>$i['buildings'],
                    'total_area'=>$i['total_area']
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
    }

    if ($_POST['data'] == 'login') {
        $user = R::findOne('users', 'WHERE phone = ?', [$_POST['login']]);
        if ($user) {
            if (md5($_POST['password']) == $user->password) {
                $arr = ['status'=>'successful', 'name'=>$user->name, 'surname'=>$user->surname, 'phone'=>$user->phone, 'email'=>$user->email, 'photo'=>$user->photo];
                $json = json_encode($arr);
                echo $json;
            } else {
                $arr = ['status'=>'error'];
                $json = json_encode($arr);
                echo $json;
            }
        } else {
            $arr = ['status'=>'error'];
            $json = json_encode($arr);
            echo $json;
        }
    }