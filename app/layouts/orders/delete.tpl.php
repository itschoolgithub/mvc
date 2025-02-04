<p class="fs-5 fw-medium">Действительно ли вы хотите удалить заказ №<?=$data['order']['id']?></p>
<a href="/order/show/<?=$data['order']['id']?>" class="btn btn-secondary">Назад</a>
<button form="form" class="btn btn-outline-danger">Удалить</button>
<form action="/order/delete/<?=$data['order']['id']?>" method="POST" id="form"></form>