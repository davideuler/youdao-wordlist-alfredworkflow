<?php
require('WordBook.php');

$word = $argv[1];

$username = getenv('netease_username');
$password = getenv('netease_password');


if (empty($username) || empty($password)) {

	echo '请设置用户名和密码';

} else {

	$wordBook = new WordBook($username, $password);

	echo $wordBook->add($word);

}
?>
