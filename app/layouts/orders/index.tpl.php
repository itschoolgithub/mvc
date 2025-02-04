<?php foreach ($data['orders'] as $order): ?>
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p class="fs-5 fw-medium">
                        <a href="/order/show/<?=$order['id']?>" class="text-dark link-underline link-underline-opacity-0"><?=$order['title']?></a>
                    </p>
                    <p><small class="text-secondary">Откликов: <?= $order['applications_count'] ?? 0 ?></small></p>
                </div>
                <div class="col-6 text-end">
                    <p class="fw-bold text-secondary">
                        <?php if ($order['price']): ?>
                            <?=$order['price']?> у.е.
                        <?php else: ?>
                            Договорная
                    <?php endif;?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>