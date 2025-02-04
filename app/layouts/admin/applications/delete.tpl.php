<p class="fs-5 fw-medium">Действительно ли вы хотите удалить отклик №<?=$data['application']['id']?></p>
<a href="/admin/application/" class="btn btn-secondary">Назад</a>
<button form="form" class="btn btn-outline-danger">Удалить</button>
<form action="/admin/application/delete/<?=$data['application']['id']?>" method="POST" id="form"></form>

