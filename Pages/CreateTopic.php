<h1>Создание темы</h1>
<form method="POST">
    <div class="input-group input-group-sm">
        <span class="input-group-addon">Имя пользователя:</span>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="input-group input-group-sm">
        <span class="input-group-addon">Имя темы:</span>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="input-group input-group-sm">
        <span class="input-group-addon">Сообщение:</span>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>