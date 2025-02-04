<p class="fs-5 fw-medium">Редактирование заказа №<?=$data['order']['id']?></p>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <form class="my-5" action="/order/edit/<?=$data['order']['id']?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=$data['order']['title'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" value="<?=$data['order']['price'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="8"><?=$data['order']['description'] ?? ''?></textarea>
            </div>
            <a href="/order/show/<?=$data['order']['id']?>" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>
</div>