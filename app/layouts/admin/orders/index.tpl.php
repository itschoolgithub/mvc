<p class="fs-5 fw-medium">Все заказы</p>
<table class="table">
    <tr>
        <th style="width: 100px;">ID</th>
        <th>Название</th>
        <th style="width: 150px;">Цена</th>
        <th>Пользователь</th>
        <th style="width: 200px;">Действия</th>
    </tr>
    <?php foreach ($data['orders'] as $order): ?>
        <tr>
            <td><?=$order['id']?></td>
            <td><?=$order['title']?></td>
            <td><?=$order['price'] ?: 'Договорная'?></td>
            <td><?=$order['user_login']?></td>
            <td>
                <a href="/admin/order/edit/<?=$order['id']?>" class="btn btn-outline-primary">🖋️</a>
                <a href="/admin/order/delete/<?=$order['id']?>" class="btn btn-outline-danger">❌</a>
            </td>
        </tr>
    <?php endforeach;?>
    <tr>
        <td></td>
        <td colspan="4">
            <a href="/admin/order/create" class="btn btn-success">Создать новый заказ</a>
        </td>
    </tr>
</table>

