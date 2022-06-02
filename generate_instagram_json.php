<?php
    $token_refresh_time = 60 * 60 * 24 * 30; // 30日おきにトークン再発行
    $token_file_path = "./token/token.txt";

    $photo_data_refresh_time = 60 * 60 * 4; // 4時間おきにjson再出力
    $photo_data_file_path = "./instagram.json";

    //保持しているトークンを取得する
    $fl = fopen($token_file_path, "r");
    $access_token = fgets($fl);
    fclose($fl);

    //$token_refresh_timeの期間が過ぎたらトークンを再取得する
    $refresh = 0;
    if (!file_exists($token_file_path)) {
        $refresh = 1;
    } else {
        $filemtime = filemtime($token_file_path);
        if((time() - $token_refresh_time) > $filemtime){
            $refresh = 1;
        }
    }
    if ($refresh == 1) {
        $url = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $access_token;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $decode = json_decode($response, true);
        $access_token = $decode["access_token"];

        $fl = fopen($token_file_path, "w");
        fwrite($fl, $access_token);
        fclose($fl);
    }

    //$photo_data_refresh_timeの期間が過ぎたら写真データを再取得する
    $refresh = 0;
    if (!file_exists($photo_data_file_path)) {
        $refresh = 1;
    } else {
        $filemtime = filemtime($photo_data_file_path);
        if ((time()-$photo_data_refresh_time) > $filemtime) {
            $refresh = 1;
        }
    }
    if ($refresh == 1) {
        $url = "https://graph.instagram.com/me/media?fields=id,caption,permalink,media_url&access_token=" . $access_token;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if (!empty($response)) {
            $fl = fopen($photo_data_file_path, "w");
            fwrite($fl, $response);
            fclose($fl);
        }
    }
