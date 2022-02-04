
<?php

require('YoudaoTranslate.php');

$keys = [
	['appKey' => getenv('youdao_appkey'), 'secret' => getenv('youdao_secret')]
];

$translator = new YoudaoTranslate($keys);
echo $translator->translate($argv[1]);

?>
