# App Installation

## Prerequisites

- ### Install [PHP 8.2](https://www.php.net/downloads.php) 

Download the PHP (8.2 or newer) installation ZIP from the link above. After downloading the file, extract the ZIP inside your local computer.

After that,register extracted folder path to you computer's PATH environment variable. the path might me something like this
>C:\php-8.4.4

To check if php is installed correctly, you can open terminal and input the command below

```
php -v
```
If the command return text similar to example below, that means php is already installed correctly

```
PHP 8.4.4 (cli) (built: Feb 11 2025 16:25:02) (ZTS Visual C++ 2022 x64)
Copyright (c) The PHP Group
Zend Engine v4.4.4, Copyright (c) Zend Technologies
```

Next, you need to change some PHP configuration in php.ini file. You need to enable some PHP features.
>these features usually disabled by default, you can see by ';' at the start of the line <br>
You need to remove the ';' at the start of the line to enable it.<br>
The code below are the features that you need to enable.

```
;extension=openssl // change this line to extension=openssl
;extension=fileinfo
;extension=zip
;extension=mbstring
;extension=pdo_mysql
;extension_dir = "ext" // change this only if you're using windows
```

- ### Install [Composer 2.8](https://getcomposer.org/download)

Download Composer-Setup.exe from the link above. after that, proceed with the installation using the Composer-Setup.exe.

To check if composer is installed correctly, you can open terminal and input the command below

```
composer -v
```

If the command return text similar to example below, that means composer is already installed correctly, and you may continue to the next step
```
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 2.8.5 2025-01-21 15:23:40

Usage:
  command [options] [arguments]
  ...
```

- ### Install [Node.js 20](https://nodejs.org/en/download)

Install Node.js 20 using the instruction from link above.

To check if Node.js is installed correctly, you can open terminal and input the command below

```
node -v
```
If the command return text similar to example below, that means node.js is already installed correctly

```
v20.16.0
```

- Install [MySQL 8](https://dev.mysql.com/downloads/installer)

Install MySQL 8 using the instruction from link above.

After completing installation, register the installation folder to your PATH environment variable. the path might be something like this
>C:\Program Files\MySQL\MySQL Server 8.0\bin

To check if MySQL is installed correctly, you can open terminal and input the command below

```
mysql -V
```
If the command return text similar to example below, that means mysql is already installed correctly

```
mysql  Ver 8.0.39 for Win64 on x86_64 (MySQL Community Server - GPL)
```

Next, you need to make a database named 'macareux'. You can use this command below to do it.
```
mysql -u root -p
```
You will be prompted to input your password. type in the password you created when you install mysql. after login success, you can create the database using this command below.

```
create database macareux;
```

## Step 1 - Install composer packages

In this step, you will be installing all the packages that are used in composer. First, you need to open a terminal and go to project's folder.

After that, you can type this command in your terminal
```
composer install
```
Please wait until the installation are completed.

## Step 2 - Install NPM packages

In this step, you will be installing all the packages that are used in NPM. First, you need to open a terminal and go to project's folder.

After that, you can type this command in your terminal
```
npm install
```
Please wait until the installation are completed.

## Step 3 - Change .env configuration

In this step, you will be setting up the configuration file for this app.

In the project folder, you will see a file named .env.example. You need to duplicate that file and rename it to .env

After that, you can change the configuration file according to your preferences.<br>for example, you can set the mysql password by changing the DB_PASSWORD value in the .env file, etc.

```
DB_CONNECTION="pdo_mysql"
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=macareux
DB_USERNAME=root
DB_PASSWORD= 
VITE_APP_NAME="${APP_NAME}"

APP_NAME=Macareux
APP_ENV=local
APP_KEY=base64:cUm2G5I8nwmi7JySSQMDomfAo5LLo3iiaVMvQ+MbJDw=
APP_TIMEZONE=UTC
APP_URL=http://localhost

CACHE_STORE=file
SESSION_DRIVER=file
```

## Step 4 - Database migration

In this step, you will be doing database migration using Doctrine. First, you need to open a terminal and go to project's folder.
After that, you can type this command in your terminal
```
php vendor/bin/doctrine-migrations migrate --no-interaction
```

## Step 5 - Deploying application in local server

In this step, you will be deploying this app in your local server. For this step, you need to open 2 separate terminal.

In first terminal, you need to execute this command

```
npm run dev
```

In second terminal, you need to execute this command

```
php artisan serve
```

After executing those 2 commands, you should be able to see the application at [127.0.0.1:8000](127.0.0.1:8000)
