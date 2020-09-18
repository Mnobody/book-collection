## Installation instructions

### Cloning 
Call terminal command in projects directory on your machine
```
git clone https://github.com/Mnobody/book-collection.git
```

### Database
Create empty database and provide configuration in file /config/params-local.php
```
// Common Cycle config
'yiisoft/yii-cycle' => [
    // Cycle DBAL config
    'dbal' => [
        'connections' => [
            'mysql' => [
                'connection' => 'mysql:host=localhost;dbname=dbname',
                'username' => 'user',
                'password' => 'pass',
            ]
        ],
    ],
```

params-local.php is merging with params.php by framework

### Migration
To execute migrations call terminal command
```
vendor/bin/yii migrate/up
```

### File permissions
```
find [path]/book-collection -type d -exec chmod 755 {} \;
find [path]/book-collection -type f -exec chmod 644 {} \;
chmod -R 777 [path]/book-collection/public/assets/
chmod -R 777 [path]/book-collection/runtime/
```
where [path] is path to project directory on your machine
execute this commands with as sudo

### Run
```
vendor/bin/yii serve
```
or configure your local apache. In case of troubles you free to delete all files in directories /public/assets/ and /runtime
 
