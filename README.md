# Temper coding Assignment

### Install
Just run `composer install`

### Tests
Just run `./vendor/bin/phpunit tests` 

- Should return 4 weeks
- First week starts from X to Y
- Group per step

Total 75
100 = 22
40 = 39
45 = 1
99 = 8
95 = 1
35 = 1
50 = 2

```php
$data = [
    'week 1' => [
        'total' => 75,
        'entries' => [
            '40' => [
                'total' => 39,
                'percentage' => 52
]           ,
            '100' => [
                'total' => 22,
                'percentage' => 29.3
            ]           
            ,
            //...
        ]   
    ]
];
```

