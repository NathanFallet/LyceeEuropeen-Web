# Lycee Europeen website, developed by Nathan Fallet

## Features

- Home page, with slides (images with text)
- Custom pages
- Articles
- File uploads
- Administration panel with multiple accounts and permissions

## Setup

### How to clone in your current directory and replace the current website

```php
<?php
`find . | xargs rm -rf`;
`git clone https://github.com/NathanFallet/LyceeEuropeen-Web ./`;
?>
```

### And setup the MySQL database

```sql
/* Table for accounts */
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `slides` tinyint(1) NOT NULL DEFAULT '0',
  `pages` tinyint(1) NOT NULL DEFAULT '0',
  `articles` tinyint(1) NOT NULL DEFAULT '0',
  `uploads` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);

/* Table for articles */
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `publish` datetime NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

/* Table for pages */
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

/* Table for slides */
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

/* Default account with credentials admin - admin to connect a first time to /admin */
INSERT INTO `accounts` (`id`, `username`, `password`, `slides`, `pages`, `articles`, `uploads`, `admin`)
  VALUES(1, 'admin', '$2y$10$80sJGXvcwGTyc3rqm3LHw.2o635mDWcVI5FmFdDH8eUriVhxIQkhK', 1, 1, 1, 1, 1);
```
