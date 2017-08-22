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
В конфигурационный файл приложения добавить компонент production

```php
    'components' => [
        'production' => [
            'class' => 'dvizh\production\Production',
        ],
        //...
    ]
```

И модуль

```php
    'modules' => [
        'production' => [
            'class' => 'dvizh\production\Module',
        ],
        //...
    ]
```

Использование
---------------------------------
Чтобы произвести что-то, нужно вызывать метод produce

yii::$app->production->produce($template); 