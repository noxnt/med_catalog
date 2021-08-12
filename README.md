# Каталогизатор лекарственных средств

## Описание проекта
Проект представляет собой **каталог лекарственных средств** с тремя основными сущностями: Лекарственное средство (**Product**), действующее вещество (**Substance**), производитель (**Maker**). Модель Product связана с моделями Substance и Maker посредством связи belongsTo, последние же связаны с моделью Product посредством связи hasMany (один ко многим). **Для всех трёх сущностей реализованы 2 API эндпоинта: WEB (ответ в виде html страницы) и JSON.**


## Структура
Стандартная Laravel MVC архитектура. HTTP запрос маршрутизируется в web.php, вызывается соответствующий контроллер (в проекте используются однометодные контроллеры для удобства и чистоты кода), в контроллере происходит валидация запроса, фильтрация, вызывается сервис, посредством модели происходит взаимодействие с БД, полученный результат возвращается в представление (или в виде JSON).


## Логирование
Логируются манипуляции (создание/изменение/удаление) с базой данных для моделей Product, Substance, Maker. В записях сообщается об успешной/неудачной манипуляции и указывается объект манипуляции. Используется драйвер single, логи хранятся по пути `storage/logs/debuginfo.log`.


## Развертывание

### Обязательно

Клонируйте репозиторий с GitHub
`git clone https://github.com/noxnt/med_catalog.git`

Перейдите в директорию проекта
`cd med_catalog`

Установите необходимые библиотеки
`composer install`

Клонируйте файл .env
`cp .env.example .env`
или
`copy .env.example .env` _(при использовании командной строки Windows)_

Откройте файл .env и настройте подключение к базе данных в соответствии с параметрами вашего сервера
`DB_DATABASE` = имя базы данных
`DB_USERNAME` = имя пользователя
`DB_PASSWORD` = пароль (по умолчанию пусто)

Сгенерируйте ключ приложения
`php artisan key:generate`

Создайте обязательные таблицы БД
`php artisan migrate`

### Дополнительно

Для заполнения БД тестовыми данными используйте
`php artisan db:seed`

Для сброса БД и повторного заполнения с тестовыми данными используйте
`php artusan migrate:fresh --seed`

Для запуска тестов используйте
`php artisan test`

Вы можете использовать **SQLite** для удобства, для этого необходимо в файле .env убрать все строки с блока `DB_*` и оставить только `DB_CONNECTION=sqlite`, так же создайте файл базы данных, использовав `touch database/database.sqlite` находясь в корне проекта.


## REST API / Front
В проекте реализованы WEB и API запросы. Для того что бы выполнить API запрос и получить ответ в виде JSON, в заголовок обычного запроса нужно добавить ключ Accept со значением /json.

**Возможные запросы:**

Метод   | URL               | Действие
--------|-------------------|---------------------------------
GET	    |'/products/create' |   получение списка (есть фильтр)
POST	|'/products'        |   создание новой записи
PATCH	|'/products/{id}'   |   изменение записи
DELETE	|'/products/{id}'   |   удаление записи

Аналогично для моделей **Maker** (`makers/`) и **Substance** (`substances/`).

**При создании записи в JSON необходимо указать обязательные ключи и их значения:**

**Product**
<pre>{
    "name": "String",
    "substance_id": 10,
    "maker_id": 5,
    "price": 100
}</pre>

**Substance**
<pre>{
    "name": "String"
}</pre>

**Maker**
<pre>{
    "name": "String",
    "link": "http://link.test"
}</pre>

## Требования
* PHP 7.3 и выше
* Локальный сервер (WAMP, OpenServer, XAMPP), либо используйте SQLite (PHPStorm)

## Linter
Код соответствует стандартам PSR-12, использовалась библиотека [ https://github.com/laravel-fans/laravel-lint ]().
