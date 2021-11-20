<?php

//设置自动加载
spl_autoload_register(function ($class) {
    include(str_replace('\\', '/', __DIR__ . '/' . $class . '.php'));
});

class Base
{
    /**
     * 当前用戶
     *
     * @var Web\User\User
     */
    public static User $user;

    public static array $error;
};

//啟用session
session_start();

//打开输出控制缓冲
ob_start();

Base::$user = new User();