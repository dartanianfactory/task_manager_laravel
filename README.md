### TASK MANAGER - TEST PROJECT

#### Тестовый админ
```
email: testing_admin@mail.ru
password: 123123
```

#### Тестовый клиент
```
email: testing_customer@mail.ru
password: 123123
```

```
docker compose up --build
docker exec -it tasker_php bash
---->php artisan migrate:fresh
---->php artisan db:seed 
---->exit

вписать SMTP в файл .env для отправки уведомлений на почту

```

```
POST http://localhost:3032/api/user/login -авторизируемся и всталяем везде в Bearer токен
{
    email,
    password,
}

GET http://localhost:3032/api/user/logout
{}

У тестовых мок-проектов id: 1, 2
GET http://localhost:3032/api/projects/{project_id}/tasks
{}

POST http://localhost:3032/api/projects/{project_id}/tasks
{
    "header": "any header",
    "description: "any description",
    "status": "planned",
    "attachment": file
}

GET http://localhost:3032/api/tasks/{id}
{}

PUT /api/tasks/{id}
{
    "header": "any header",
    "description: "any description",
    "status": "planned",
}

DELETE /api/tasks/{id}
{}
