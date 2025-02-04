<p class="fs-5 fw-medium">Все пользователи</p>
<table class="table">
    <tr>
        <th style="width: 100px;">ID</th>
        <th>Логин</th>
        <th style="width: 150px;">Администратор</th>
        <th style="width: 200px;">Действия</th>
    </tr>
    <?php foreach ($data['users'] as $user): ?>
        <tr>
            <td><?=$user['id']?></td>
            <td><?=$user['login']?></td>
            <td><?=$user['is_admin'] ? '✅' : '🫠'?></td>
            <td>
                <a href="/admin/user/edit/<?=$user['id']?>" class="btn btn-outline-primary">🖋️</a>
                <a href="/admin/user/delete/<?=$user['id']?>" class="btn btn-outline-danger">❌</a>
            </td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td></td>
        <td colspan="3">
            <a href="/admin/user/create" class="btn btn-success">Создать нового пользователя</a>
        </td>
    </tr>
</table>
