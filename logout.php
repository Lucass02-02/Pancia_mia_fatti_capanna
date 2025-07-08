<?php
require_once 'AppORM/Services/Utility/USession.php';

use AppORM\Services\Utility\USession;

USession::start();
USession::destroy();

header('Location: login.php');
exit;
