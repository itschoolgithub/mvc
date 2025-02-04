<p class="fs-5 fw-medium">Создание заказа</p>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <form class="my-5" action="/admin/order/create" method="POST">
            <div class="mb-3">
                <label for="user_id" class="form-label">Пользователь</label>
                <select class="form-select" id="user_id" name="user_id">
                    <?php foreach ($data['users'] as $user) : ?>
                        <option value="<?= $user['id'] ?>"><?= $user['login'] ?></option>
                    <?php endforeach; ?> 
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$_POST['title'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="<?=$_POST['price'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="8"><?=$_POST['description'] ?? ''?></textarea>
            </div>
            <a href="/admin/order" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
</div>
