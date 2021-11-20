<?php
include __DIR__ . '/../framework/ModBase.php';
$d = new Mod\demo4();
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../src/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../src/css/bootstrap-vue.min.css" />
    <link type="text/css" rel="stylesheet" href="../public.css" />
    <script src="../src/js/vue.min.js"></script>
    <script src="../src/js/bootstrap-vue.min.js"></script>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../src/js/bootstrap-vue-icons.min.js"></script> -->
    <title>
        test
    </title>
</head>

<body>
    <?php include __DIR__  . '/../nav.php'; ?>
    <div id="app" class="container">
        <div class="row">
            <div class="col">
                <b-calendar locale="zh-cn" width="100%">
                </b-calendar>
                <p></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>用户所在组:<?php foreach (Base::$user->getGroupList() as $v) : ?> <span class="badge rounded-pill bg-primary"><?= $v ?></span><?php endforeach; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>销售部门 才有权限访问demo4</p>
                <p><a href="./action1.php">开发者 才有权限访问 action1</a></p>
                <p><a href="./action2.php">高级管理员 才有权限访问 action2</a></p>
                <p><a href="./action3.php">销售部门 才有权限访问 action3</a></p>
                <p><a href="./action4.php">普通用户 才有权限访问 action4</a></p>
            </div>
        </div>
    </div>
    <script>
        var app = new Vue({
            el: "#app"
        });
    </script>
    <?php include __DIR__  . '/../footer.php'; ?>
</body>

</html>