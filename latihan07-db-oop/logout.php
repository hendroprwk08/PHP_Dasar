<?php
include "session.php";
$s = new Session();
if ($s->destroy()) header("location: login.php");
?>