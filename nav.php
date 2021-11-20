<?php
if (isset($_GET['nav_changeuser'])) {
    Base::$user->login($_GET['nav_changeuser']);
    header('Location: ./');
}
?>

<!-- 通用导航栏 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            Foo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nsc1" aria-controls="nsc1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nsc1">
            <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="nbd1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= Base::$user->getUserName() ?>(点击切换用户)
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="nbd1">
                        <?php foreach (User::getUserList() as $v) : ?>
                            <li><a class="dropdown-item" href="./?nav_changeuser=<?= $v->username ?>"><?= $v->username ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>