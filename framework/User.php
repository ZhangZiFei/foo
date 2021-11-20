<?php

/**
 * 用戶
 */
class User
{
    /**
     * 获取用户列表
     *
     * @return array
     */
    public static function getUserList()
    {
        if (self::$userList === []) {
            return (self::$userList = json_decode(file_get_contents(__DIR__ . '\..\DataBase\User.json')));
        } else {
            return self::$userList;
        }
    }

    public function __construct()
    {
        if (self::IsLogin()) {
            //已经登入
            $this->setUserInfo();
        }else{
            $this->login('用户1');
        }
    }

    /**
     * 登入
     *
     * @param string $username 用户名
     * @return void
     */
    public function login(string $username)
    {
        $_SESSION['username'] = $username;
        $this->setUserInfo();
    }

    /**
     * 是否登入
     *
     * @return bool
     */
    public static function IsLogin()
    {
        return isset($_SESSION['username']);
    }

    /**
     * 获取用户名
     *
     * @return void
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * 登出
     *
     * @return void
     */
    public function loginOut()
    {
        unset($_SESSION['username']);
    }

    private static array $userList = [];

    /**
     * 用户名
     *
     * @var string
     */
    private string $username = '';

    /**
     * 用户信息
     */
    private $userInfo;

    /**
     * 设置用户信息
     *
     * @return void
     */
    private function setUserInfo()
    {
        $this->username = $_SESSION['username'];

        foreach (self::getUserList() as $v) {
            if ($v->username === $this->username) {
                $this->userInfo = $v;
                return;
            }
        }
        throw new NotFondUserException();
    }

    //----------------------------------权限管理---------------------------------------

    /**
     * 获取用户所在组
     *
     * @return array
     */
    public function getGroupList()
    {
        return $this->userInfo->groups;
    }

    /**
     * 查询是否为某组成员
     *
     * @param string $group 组名称
     * @return bool
     */
    public function checkGroup(string $group)
    {
        foreach($this->getGroupList() as $v)
        {
            if ($v === $group) {
                return true;
            }
        }
        return false;
    }

    /**
     * 权限检查
     * 
     * `开发者`拥有所有其他组的权限，`高级管理员`拥有除开发者之外的所有其他组的权限
     *
     * @param string $group 组名称
     * @return bool
     */
    public function checkPermissions(string $group)
    {
        if ($this->checkGroup('开发者')) {
            return true;
        } else if ($group !== '开发者' and $this->checkGroup('高级管理员')) {
            return true;
        } else {
            return $this->checkGroup($group);
        }
    }
    
    /**
      * 权限检查_t
      *
      * 如果没有权限会抛出异常
      *
      * @param string $group 用户组
      */
    public function checkPermissions_t(string $group)
    {
        if (!$this->checkPermissions($group)) {
            throw new NoPermissionsException($group);
        }
    }

    /**
     * 获取用户的页面列表
     *
     * @return array
     */
    public function getPages()
    {
        $p = [];
        $Pages = json_decode(file_get_contents(__DIR__ . '\..\DataBase\Pages.json'));
        foreach ($Pages as $v) {
            if ($this->checkPermissions($v->authority)) {
                array_push($p, $v->v);
            }
        }
        return $p;
    }
}

//------------------------------异常类------------------------------------------------

/**
 * 用户系统异常
 */
class UserException extends Exception
{
}

/**
 * 没有找到用户
 */
class NotFondUserException extends UserException
{
    public function __construct()
    {
        parent::__construct('没有找到用户');
    }
}

/**
 * 用户没有登入
 */
class NoLoginException extends UserException
{
}

/**
 * 权限不足
 */
class NoPermissionsException extends Exception
{
    /**
     * @param string $group 用户组
     */
    public function __construct(string &$group)
    {
        parent::__construct("此操作（页面）需要\"$group\"权限才能访问");
    }
}
