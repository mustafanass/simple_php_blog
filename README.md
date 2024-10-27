# simple_php_blog
this applications its simple blog application its small blog platform build using php pure without any framworks .

# Technology used to build it 
- using php pure (php v7.4.33) .
- using bootstrap for css and styling (bootstrap v4.5.2)
- using font-awesome for icons (font-awesome v5.15.4)
- using mysql for database (mariadb v10.6.11)
- NOTE : i use CDN for both bootstrap , font-awesome you can change it using local files no problem 

# Create Database requerment
1- Create Database
```
CREATE DATABASE blog_platform;

USE blog_platform;
```
2- Create tables for database 
- run this commends to create all app tables for the database 
```
php setup_database.php
```
# package requirement 
- php package make sure you install requirement php package for me i use linux debain 12 so i install these package
  ```
  sudo apt update
  sudo apt upgrade
  sudo apt install php libapache2-mod-php php-mysql php-cli php-zip php-curl php-mbstring php-xml php-gd
  ```
- install web servcer i use apache2 with this config files
  1- Create a Virtual Host Configuration File 
  ```
  cd /etc/apache2/sites-available/
  sudo nano zainiq-blog-tasks.conf
  ```
  2- Add the following configuration to the file ( you can change it for your requirement ):
  ```
  <VirtualHost *:80>
    ServerAdmin admin@yourdomain.com
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com

    DocumentRoot /var/www/html

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
  ```
  3- Enable the Virtual Host and Disable the default Site Configuration If Necessary:
  
  ```
  sudo a2ensite zainiq-blog-tasks.conf
  sudo a2dissite 000-default.conf
  sudo systemctl restart apache2
  ```
  4- Ensure You Give File Permissions
  ```
  sudo chown -R www-data:www-data /var/www/html
  sudo chmod -R 755 /var/www/html
  ```
  5- test your browser if some page dont works fine make sure you add .htaccess files and use this commend to ensure  Apache modules are enabled
  ```
  sudo a2enmod rewrite
  sudo systemctl restart apache2
  ```

  
  # app struct description
  ```
/zainiq-blog-tasks
├── /assets
│   ├── /css
│   │   └── style.css
│   └── /images
├── /app
│   ├── /controllers
│   │   ├── PostController.php
│   │   └── UserController.php
│   ├── /models
│   │   ├── Post.php
│   │   └── User.php
│   ├── /views
│   │   ├── /layouts
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── /posts
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── show.php
│   │   └── /users
│   │       ├── login.php
│   │       └── register.php
├── /config
│   └── database.php
|   |__ setup_tables.php
├── /routes
│   └── routes.php
└── .htaccess
|__ index.php

  ```
