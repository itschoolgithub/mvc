<p class="fs-5 fw-medium">Создание пользователя</p>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <form class="my-5" action="/admin/user/create" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" name="login" value="<?=$_POST['login'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="text" class="form-control" id="password" name="password" value="<?=$_POST['password'] ?? ''?>">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="is_admin" name="is_admin">
                    <label class="form-check-label" for="is_admin">
                        Администратор
                    </label>
                </div>
            </div>
            <a href="/admin/user" class="btn btn-outline-secondary">Назад</a>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>
    </div>
</div>

