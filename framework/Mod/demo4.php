<?php

namespace Mod;

use Base;

class demo4
{
    public function __construct()
    {
        //销售部门 才有权限访问demo4
        Base::$user->checkPermissions_t("销售部门");
    }

    public function action1()
    {
        //开发者 才有权限访问 action1
        Base::$user->checkPermissions_t("开发者");
        return "action1 操作成功";
    }

    public function action2()
    {
        //高级管理员 才有权限访问 action2
        Base::$user->checkPermissions_t("高级管理员");
        return "action2 操作成功";
    }

    public function action3()
    {
        //销售部门 才有权限访问 action3
        Base::$user->checkPermissions_t("销售部门");
        return "action3 操作成功";
    }

    public function action4()
    {
        //普通用户 才有权限访问 action4
        Base::$user->checkPermissions_t("普通用户");
        return "action4 操作成功";
    }
}