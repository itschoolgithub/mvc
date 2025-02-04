<p class="fs-5 fw-medium">Все отклики</p>
<table class="table">
    <tr>
        <th style="width: 100px;">ID</th>
        <th>Заказ</th>
        <th>Пользователь</th>
        <th style="width: 200px;">Действия</th>
    </tr>
    <?php foreach ($data['applications'] as $application): ?>
        <tr>
            <td><?=$application['id']?></td>
            <td><?=$application['order_title']?></td>
            <td><?=$application['user_login']?></td>
            <td>
                <a href="/admin/application/edit/<?=$application['id']?>" class="btn btn-outline-primary">🖋️</a>
                <a href="/admin/application/delete/<?=$application['id']?>" class="btn btn-outline-danger">❌</a>
            </td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td></td>
        <td colspan="3">
            <a href="/admin/application/create" class="btn btn-success">Создать новый отклик</a>
        </td>
    </tr>
</table>

