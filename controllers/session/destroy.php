<?php

//logout
$_SESSION=[];
session_destroy();

setcookie(session_name(), session_id(), time() - 3600);

header("Location: /");
exit();