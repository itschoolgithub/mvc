<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Freelance</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/order">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/order/create">Создать заказ</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if ($is_auth): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Выйти</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Вход</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Регистрация</a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php if ($is_admin): ?>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/user">Пользователи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/order">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/application">Отклики</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    <?php endif;?>

    <div class="container my-3">
        <?php foreach (['success', 'info', 'warning', 'danger'] as $notify): ?>
            <?php if (isset($_SESSION[$notify])): ?>
                <div class="alert alert-<?=$notify?> my-2">
                    <?=$_SESSION[$notify]?>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    </div>

    <div class="container my-3">
        <?php include $contentFile?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>