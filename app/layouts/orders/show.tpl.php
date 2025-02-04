<p class="fs-5 fw-medium"><?=$data['order']['title']?></p>
<p class="fw-bold text-secondary">
    <?php if ($data['order']['price']): ?>
        <?=$data['order']['price']?> у.е.
    <?php else: ?>
        Договорная
    <?php endif;?>
</p>
<p><small class="text-secondary">Откликов: <?= $data['order']['applications_count'] ?? 0 ?></small></p>
<p><?=$data['order']['description']?></p>

<?php if ($is_auth): ?>
    <?php if ($data['has_permision']): ?>
        <a href="/order/edit/<?=$data['order']['id']?>" class="btn btn-outline-primary">Отредактировать</a>
        <a href="/order/delete/<?=$data['order']['id']?>" class="btn btn-outline-danger">Удалить</a>

        <div class="row mt-4">
            <div class="col">
                <?php if ($data['applications']): ?>
                    <p class="fs-5">Откликнувшиеся пользователи:</p>
                    <ul class="list-group ">
                        <?php foreach ($data['applications'] as $application) : ?>
                            <li class="list-group-item"><?= $application['user_login'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="fs-5 text-muted">Откликнувшихся пользователей пока нет</p>
                <?php endif;?>
            </div>
        </div>
    <?php else: ?>
        <?php if (true): ?>
            <a href="/order/reply/<?=$data['order']['id']?>" class="btn btn-outline-primary">Откликнуться</a>
        <?php else: ?>
            <p class="text-primary fs-5">Вы откликнулись на этот заказ</p>
        <?php endif;?>
    <?php endif;?>
<?php else: ?>
    <p class="text-primary text-center"><a href="/login">Войдите</a> или <a href="/register">зарегистрируйтесь</a>, чтобы откликаться на заказы</p>
<?php endif;?>
