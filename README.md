Yii2-production
==========
Сбор продуктов из любых компонентов. 

Установка
---------------------------------
Выполнить команду

```
php composer require dvizh/yii2-production "@dev"
```

Или добавить в секцию require composer.json

```
"dvizh/yii2-production": "@dev",
```

И выполнить

```
php composer install
```

Далее, мигрируем базу:

```
php yii migrate --migrationPath=vendor/dvizh/yii2-production/src/migrations
```

Подключение и настройка
---------------------------------
В конфигурационный файл приложения добавить модуль production

И модуль (если хотите использовать виджеты)

```php
    'modules' => [
        'production' => [
            'class' => 'dvizh\production\Module',
        ],
        //...
    ]
```