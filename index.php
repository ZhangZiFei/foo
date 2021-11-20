<?php
include __DIR__ . '/framework/ModBase.php';
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="./src/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="./src/css/bootstrap-vue.min.css" />
    <link type="text/css" rel="stylesheet" href="./public.css" />
    <script src="./src/js/vue.min.js"></script>
    <script src="./src/js/bootstrap-vue.min.js"></script>
    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../src/js/bootstrap-vue-icons.min.js"></script> -->
    <title>
        HelloWorld
    </title>
</head>

<body>
    <?php include __DIR__  . '/nav.php'; ?>
    <div id="app" class="container">
        <div class="row">
            <div class="col">
                <p>{{txt}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>用户所在组:<?php foreach (Base::$user->getGroupList() as $v) : ?> <span class="badge rounded-pill bg-primary"><?= $v ?></span><?php endforeach; ?></p>
                    <!-- <pre><?php var_dump(Base::$user->getPages()) ?></pre> -->
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 gy-2">
            <?php foreach (Base::$user->getPages() as $v) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="<?=$v->href ?>" class="card-link"><?=$v->name ?></a></h5>
                            <!-- <h6 class="card-subtitle mb-2 text-muted">查看網頁的運行日誌</h6> -->
                            <p class="card-text" style="text-align: left;"><?=$v->description ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
        
        <script>
            var app = new Vue({
                el: " #app",
                data: {
                    txt: "HelloWorld!!!"
                }
            });
        </script>
        <?php include __DIR__  . '/footer.php'; ?>
</body>

</html>