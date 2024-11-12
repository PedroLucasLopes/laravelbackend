<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📢 CRUD To-do

This campaign management system aims primarily to perform a complete maintenance review of pre-established business rules for creating campaigns across various segments.

## 🧑🏻‍💻 Project Technologies

- ### 🔶 Laravel
  - Laravel is a web application framework with expressive, elegant syntax. They believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web application.
- ### 🐬 MySQL
  - MySQL is an open-source relational database management system used to store and manage structured data with support for SQL.
- ### 🧪 PHPUnit
  - PHPUnit is a testing framework for PHP, used to write and run unit tests to ensure the correctness of code.

## ⚙️ API routes created in the project

### Tasks
#### Route to create a task

```http
  POST /api/tasks
```

| Parameters       | Type     | Example Value                                  |
| :--------------- | :------- | :--------------------------------------------- |
| `name`           | `string` | Do market                                      |
| `description`       | `string` | Buy some groceries                                        |

#### Route to get all tasks

```http
  GET /api/tasks?page={{page}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `page`    | `number` | 1      |

#### Route to get a task by id

```http
  GET /api/tasks/{{id}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

#### Route to update a task

```http
  UPDATE /api/tasks/{{id}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

```http
  DELETE /api/tasks/{{id}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

### Subtasks
#### Route to create a subtask

```http
  POST /api/subtasks/{{taskId}}
```

| Query Parameter      | Type     | Example Value                                  |
| :--------------- | :------- | :--------------------------------------------- |
| `taskId`           | `number` | 10                                     |

#### Route to get a task by id

```http
  GET /api/subtasks/{{subtaskId}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

#### Route to update a campaign

```http
  UPDATE /api/subtasks/{{id}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

```http
  DELETE /api/subtasks/{{id}}
```

| Query Parameter | Type     | Example Value |
| :-------- | :------- | :------------ |
| `id`    | `string` | 10      |

#### Note

- Every route and testing can be checked on <a href="https://www.postman.com/flight-engineer-94720812/workspace/crud-to-do/collection/22348918-7a88604a-9283-4742-986d-b0f6c21e1d93?action=share&creator=22348918&active-environment=22348918-3f914b74-ebf9-4651-abab-8e32f34a55eb">Postman Collection</a>

## ✏️ Project Initialization

To initiate the project, open your bash within the project folder and start with:

```bash
  composer install
```

Generate a key

```bash
  php artisan key:generate
```

Create Database

```bash
  php artisan migrate
```

Start Laravel

```bash
  php artisan serve
```

## 🧑🏻‍🎨 Author

- [Pedro Lucas Lopes Paraguai](https://www.github.com/PedroLucasLopes)
  I have always been determined about what I want as a developer, curious to learn new technologies, and deepen my knowledge in those I work with. Five years ago, I entered the market aiming to showcase my potential by bringing innovations to both Front-end and Back-end realms within the web.

## 🏷️ Tags

[![PHP](https://img.shields.io/badge/-PHP-blue?logo=php)](https://img.shields.io/badge/-php-blue?logo=php)
[![Laravel](https://img.shields.io/badge/-Laravel-red?logo=laravel)](https://img.shields.io/badge/-laravel-blue?logo=laravel)
