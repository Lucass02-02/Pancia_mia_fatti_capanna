<?php
$password = '1'; // o la password che vuoi
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;
