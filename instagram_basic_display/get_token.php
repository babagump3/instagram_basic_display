<?php
    // 短期アクセストークンの取得
    $getAccessToken = function($client_id, $client_secret, $redirect_uri, $code) {
        $url = 'https://api.instagram.com/oauth/access_token';
        $params = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect_uri,
            'code' => $code
        ];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $decode = json_decode($response, true);
        return($decode);
    };

    // 長期アクセストークンの取得
    $getLongLivedAccessToken = function($access_token, $client_secret) {
        $url = 'https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret=' . $client_secret . '&access_token=' . $access_token;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $decode = json_decode($response, true);
        return($decode);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram トークン取得</title>
</head>
<body>
<?php
    if ($_POST['client_id'] && $_POST['client_secret'] && $_POST['auth_url']) {
        $client_id = $_POST['client_id'];
        $client_secret = $_POST['client_secret'];
        $parsed_url = parse_url($_POST['auth_url']);
        $redirect_uri = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
        $auth_code = str_replace('code=', '', $parsed_url['query']);
        $error_message = '';

        $access_token_array = $getAccessToken($client_id, $client_secret, $redirect_uri, $auth_code);
        if (isset($access_token_array['access_token'])) {
            $long_lived_access_token_array = $getLongLivedAccessToken($access_token_array['access_token'], $client_secret);
            if (isset($long_lived_access_token_array['access_token'])) {
                $long_lived_access_token = $long_lived_access_token_array['access_token'];
            } else {
                $error_message = $long_lived_access_token_array['code'] . ': ' . $long_lived_access_token_array['error_message'];
            }
        } else {
            $error_message = $access_token_array['code'] . ': ' . $access_token_array['error_message'];
        }

        if ($long_lived_access_token) {
?>
    <p>アクセストークンを取得できました。</p>
    <p style="color: blue; font-weight: bold;"><?php echo $long_lived_access_token; ?></p>
    <p><a href="get_token.php">もう一度</a></p>
<?php
        } else {
?>
    <p>アクセストークンを取得できませんでした。</p>
    <p style="color: red; font-weight: bold;"><?php echo $error_message; ?></p>
    <p><a href="get_token.php">もう一度</a></p>
<?php
        }
    } else {
?>
    <form action="get_token.php" method="POST">
        <p>InstagramアプリID<br>
            <input type="text" name="client_id" value="<?php echo htmlspecialchars($_POST['client_id']); ?>" /></p>
        <p>Instagram App Secret<br>
            <input type="text" name="client_secret" value="<?php echo htmlspecialchars($_POST['client_secret']); ?>" /></p>
        <p>認証画面のURL<br>
            <input type="text" name="auth_url" value="<?php echo htmlspecialchars($_POST['auth_url']); ?>" /></p>
        
        <button>送信</button>
    </form>
<?php
    }
?>

</body>
</html>





