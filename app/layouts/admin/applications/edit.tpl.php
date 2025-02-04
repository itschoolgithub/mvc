<p class="fs-5 fw-medium">Редактирование отклика №<?=$data['application']['id']?></p>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <form class="my-5" action="/admin/application/edit/<?=$data['application']['id']?>" method="POST">
            <div class="mb-3">
                <label for="user_id" class="form-label">Пользователь</label>
                <select class="form-select" id="user_id" name="user_id">
                    <?php foreach ($data['users'] as $user) : ?>
                        <option value="<?=$user['id']?>"><?= $user['login'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="order_id" class="form-label">Заказ</label>
                <select class="form-select" id="order_id" name="order_id">
                    <?php foreach ($data['orders'] as $order) : ?>
                        <option value="<?=$order['id']?>"><?= $order['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="/admin/application" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>
</div>

