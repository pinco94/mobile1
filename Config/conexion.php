<?php
$manejador="mysql";
$servidor="basews08.db.8917278.hostedresource.com";
$usuario="basews08";
$pass="XZ7rADss89@gvc5";
$base="basews08";
$cadena="$manejador:host=$servidor;dbname=$base";
$cnx = new PDO($cadena,$usuario,$pass);
?>