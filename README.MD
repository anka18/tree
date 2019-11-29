### 1. Установка docker-compose

https://docs.docker.com/compose/install/

### 2. Управление проектом

#### 2.1 Сборка проекта

```
docker-compose build
```

#### 2.2 Запуск проекта
В интереактивном режиме
```
docker-compose up
```
В фоновом режиме
```
docker-compose up -d
```

Проект будет доступен по адресу http://127.0.0.1:9090

#### 2.3 Остановка проекта
```
docker-compose down
```


Загрузить дамп БД (находится в корне проекта) можно через phpMyAdmin

http://localhost:8080/
