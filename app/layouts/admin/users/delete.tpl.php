<p class="fs-5 fw-medium">Действительно ли вы хотите удалить пользователя №<?=$data['user']['id']?></p>
<a href="/admin/user/" class="btn btn-secondary">Назад</a>
<button form="form" class="btn btn-outline-danger">Удалить</button>
<form action="/admin/user/delete/<?=$data['user']['id']?>" method="POST" id="form"></form>
