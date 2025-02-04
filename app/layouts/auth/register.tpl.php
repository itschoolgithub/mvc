<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <h3 class="mt-5 text-center">Регистрация</h3>
        <form class="my-5" action="/register" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" name="login" value="<?=$_POST['login'] ?? ''?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
</div>