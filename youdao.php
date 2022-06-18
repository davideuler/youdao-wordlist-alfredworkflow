
<?php

require('YoudaoTranslate.php');

$keys = [
	['appKey' => getenv('youdao_appkey'), 'secret' => getenv('youdao_secret')]
];

$translator = new YoudaoTranslate($keys);

$arguments = array_slice($argv, 1);
$keyword = implode(" ", $arguments);
echo $translator->translate($keyword);

?>
