<?php
    require_once '../orm/db.php';

    if ($_GET['data'] == 'pwa') {
        function get_apartments() {
            $list = R::findAll('apartments');
            $array = [];
            foreach ($list as $i) {
                array_push($array, [
                    'id'=>$i['id'],
                    'photo'=>$i['photo'],
                    'title'=>$i['title'],
                    'price'=>$i['price'],
                    'price_metr'=>$i['price_metr'],
                    'total_area'=>$i['total_area'],
                    'kitchen_area'=>$i['kitchen_area'],
                    'living_area'=>$i['living_area'],
                    'floor'=>$i['floor'],
                    'finishing'=>$i['finishing'],
                    'description'=>$i['description'],
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