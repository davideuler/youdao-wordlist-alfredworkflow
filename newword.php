<?php
try {
    echo "start add word";
    $input = "positive ADD";
    $inputs = explode("\\ ", $input);
    $input = implode(" ", $inputs);

    if (strlen($input) > 3 && substr($input, -3) == "ADD") {
        $word = substr($input, 0, -3);
        $username = "email";     //替换成自己的网易帐号
        $password = "encrypted_password";  //替换成自己的网易密码, 浏览器登陆时，Post到服务器端的密码，有经过js加密
        $contentType = "application/x-www-form-urlencoded";
        $userAgent = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4";
        $body = array(
		'url'=>"http://account.youdao.com/login?service=dict&back_url=http://dict.youdao.com/wordbook/wordlist%3Fkeyfrom%3Dnull",
		'app'=>"web",
		'tp' =>"urstoken",
		'cf' =>3,
		'fr' =>1,
		'ru' =>"http://dict.youdao.com/wordbook/wordlist?keyfrom=null",
                'product'=>"DICT",
		'type'=>1,
		'um' =>true,
                'username'=>$username,
                'password'=>$password,
                'savelogin'=>1
                );
        $fields_string = http_build_query($body);

        $url = "https://logindict.youdao.com/login/acc/login";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: '.$contentType . '; User-Agent=' . $userAgent));
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_TIMEOUT, 6);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $cookies = array();
        preg_match_all('/Set-Cookie:(?<cookie>.*)\b/m', $result, $cookies);
        $cookie_string = trim(implode(",", $cookies['cookie']));
	curl_close($ch);
	//echo "cookie: $cookie_string \n";
	//echo "$result \n";

        // 添加单词到单词本
	      //$add_word_url = 'http://dict.youdao.com/wordbook/wordlist?action=add';
        $add_word_url = 'http://dict.youdao.com/wordbook/ajax?action=addword&q='.$word;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $add_word_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result2 = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code==200) {
            // 202 is accepted, 409 is already exists
            if($result2=='{"message":"adddone"}') {
                //exit(0); // success
                echo "add \"$word\" Success";
	    }else{

                //exit(1); // other error
                echo "add \"$word\" Failed: code: $code, $result2";
	    }

        }
        else if ($code==401) {
            //exit(2); // bad auth
            echo "Bad Auth when connect to YouDao Wordbook";
        }
        else {
            //exit(1); // other error
            echo "Encounter Other Error when connect to YouDao Wordboook";
        }
    }
} catch (Exception $e) {
    echo "";
}
