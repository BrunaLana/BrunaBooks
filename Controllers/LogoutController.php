<?php

require_once '../Helpers/SessionHelper.php';

SessionHelper::startSession();
SessionHelper::logout();
header('Location: ../index.php');
exit();
