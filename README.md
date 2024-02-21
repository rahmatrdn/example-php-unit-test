# Example Implementation Unit Testing in PHP
Contoh Project PHP dengan implementasi Unit Testing. Disini menggunakan Framework Laravel, namun kamu bisa implementasikan pada Framework yang lain (Yii, Codeigniter, etc.).

## Contact
| Name              | Email                           | Role       |
| :----------------:|:-------------------------------:|:----------:|
| Rahmat Ramadhan Putra  | rahmatrdn.dev@gmail.com    | Author   |

## Prerequisite
- Laravel 10.44.0
- PHP 8.1.10
- PHP Extension Xdebug
- PHPUnit 9.6.16
- Codeception Specify
- Xdebug v3.2.2 (Optional untuk melihat code coverage)

## Structure Architecture
Menggunakan MVC (Model-View-Controller) yang di modif menjadi **Clean Architecture**.
- Controller : Sebagai handle request dan response
- Usecase : Layer untuk menulis business logic
- Repository : Layer untuk mengelola data (database, 3rd party API, etc.)
- Entity : Layer untuk mendifinisikan object data

## How To Install
Perhatian: Pastikan versi PHP sama dengan Prerequisite diatas!
1. Composer Update
    ```
    composer update
    ```
2. Jalankan Test!

## How To Run The Tests
> **Running Test (Tanpa cek Coverage)**
```
./vendor/bin/phpunit tests --testdox
```

> **Running Tests dengan cek Coverage**
    Pastikan sudah terinstall Xdebug pada PHPnya.
```
./vendor/bin/phpunit --testdox --coverage-html tests/coverage
```