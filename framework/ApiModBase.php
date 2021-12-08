<?php
include __DIR__ . '/ApiBase.php';

//登入檢查
if (!Base::$user->IsLogin()) {
    throw new Web\User\NoLoginException();
}
