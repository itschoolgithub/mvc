<p class="fs-5 fw-medium">Действительно ли вы хотите откликнуться на заказ №<?=$data['order']['id']?></p>
<a href="/order/show/<?=$data['order']['id']?>" class="btn btn-outline-secondary">Назад</a>
<button form="form" class="btn btn-success">Откликнуться</button>
<form action="/order/reply/<?=$data['order']['id']?>" method="POST" id="form"></form>