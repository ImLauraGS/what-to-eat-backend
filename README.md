SPANISH V.

## 🌸 Descripción

Proyecto de recetas que consiste en a partir de selecionar ingredientes, se sugiere una serie de recetas. Los usuarios puede registrarse y realizar un CRUD entero para sus recetas.

El proyecto de recetas está siendo desarrollado como parte del curso en IT Academy de Barcelona Activa. Utiliza tecnologías modernas tanto en el frontend como en el backend para ofrecer una plataforma interactiva donde los usuarios pueden buscar recetas, añadir nuevas recetas, y gestionar sus favoritos. El frontend está construido con React utilizando Vite como bundler, Axios para comunicarse con el backend, y está estilizado principalmente con Tailwind CSS, además de algunos componentes de Material UI. Por otro lado, el backend se desarrolló en Laravel, siguiendo el patrón MVC y proporcionando una API Restful para gestionar las operaciones de las recetas. Se realizaron pruebas exhaustivas utilizando PHPUnit para garantizar la calidad y fiabilidad de los endpoints. El proyecto también incluye un diseño inicial en Figma para las vistas móviles, con planes para expandirlo a una versión de escritorio en el futuro.

Este repositorio va unido al repositiorio de front: [Aqui](https://github.com/ImLauraGS/what-to-eat-frontend)

## 💻 Tecnologias usadas

<div>
<img alt="Static Badge" src="https://img.shields.io/badge/Laravel-10.10-blue">
<br>
<img alt="Static Badge" src="https://img.shields.io/badge/PHP-8.1-blue">
<br>
</div>


## ⚙️ Instalación

Aquí tienes una breve descripción de cómo poder ver nuestro proyecto. Para ejecutarlo necesitas tener conocimientos previos sobre como funciona Mamp/Xamp y tener instalado composer.

1. Clona el repositorio tanto de back como de front.

```bash
git clone https://github.com/ImLauraGS/what-to-eat-frontend.git
git clone https://github.com/ImLauraGS/what-to-eat-backend.git
``` 
2. Instalar dependencias.

```bash
composer i
``` 

3. Crear la base de datos en phpMyAdmin.

4. Configurar el archivo .env:

```bash
DB_DATABASE=namedatabase
DB_USERNAME=root
DB_PASSWORD=
``` 
Ten en cuenta, que a veces en MAC y si usas MAMP, es posible que la contraseña del usuario root sea "root".

5. Migra las tablas a la base de datos:

```bash
php artisan migrate
``` 

6. Levantar el servidor (recuerda tener XAMP/MAMP encendido):

```bash
php artisan serve
``` 
IMPORTANTE: Este backend se utiliza con el frontend: [Aqui](https://github.com/ImLauraGS/what-to-eat-frontend.git)


## 🔗 Autora

![Laura](https://avatars.githubusercontent.com/ImLauraGS?s=50) 
Laura G. 
[LinkedIn](https://www.linkedin.com/in/laura-gil-solano/)


_______________________________________________________________________

ENGLISH V.

## 🌸 Description

Recipe project that, based on selected ingredients, suggests a series of recipes. Users can register and perform complete CRUD operations for their recipes.

The recipe project is being developed as part of the IT Academy course at Barcelona Activa. It utilizes modern technologies in both frontend and backend to provide an interactive platform where users can search for recipes, add new recipes, and manage their favorites. The frontend is built with React using Vite as the bundler, Axios for backend communication, and styled primarily with Tailwind CSS, supplemented by some Material UI components. On the other hand, the backend is developed in Laravel, following the MVC pattern and providing a Restful API to manage recipe operations. Comprehensive testing was conducted using PHPUnit to ensure the quality and reliability of the endpoints. The project also includes an initial design in Figma for mobile views, with plans to expand to a desktop version in the future.

This repository is linked to the frontend repository: [Here](https://github.com/ImLauraGS/what-to-eat-frontend)

## 💻 Technologies Used

<div>
<img alt="Static Badge" src="https://img.shields.io/badge/Laravel-10.10-blue">
<br>
<img alt="Static Badge" src="https://img.shields.io/badge/PHP-8.1-blue">
<br>
</div>


## ⚙️ Installation
Here is a brief description of how to view our project. To run it, you need prior knowledge of how Mamp/Xamp works and have Composer installed.

 1. Clone both the backend and frontend repositories.

 ```bash
git clone https://github.com/ImLauraGS/what-to-eat-frontend.git
git clone https://github.com/ImLauraGS/what-to-eat-backend.git
``` 

2. Install dependencies.

```bash
composer i
``` 
3. Create the database in phpMyAdmin.

4. Configure the .env file:
```bash
DB_DATABASE=namedatabase
DB_USERNAME=root
DB_PASSWORD=
``` 
Keep in mind that sometimes on a MAC, if you are using MAMP, the password for the root user might be "root".

5. Migrate the tables to the database:

```bash
php artisan migrate
``` 

3. Start the server (remember to have XAMP/MAMP running).

```bash
php artisan serve
``` 

 IMPORTANT: This backend is used with the frontend: [Here](https://github.com/ImLauraGS/what-to-eat-frontend.git)

## 🔗 Author
 ![Laura](https://avatars.githubusercontent.com/ImLauraGS?s=50) 
 Laura G. 
 [LinkedIn](https://www.linkedin.com/in/laura-gil-solano/)
