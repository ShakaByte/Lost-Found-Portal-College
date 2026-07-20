# Lost-Found-Portal-College
A mini project developed in 2nd year for Database Management Systems course. It is a web based Lost and Found Portal for college campus, enabling students to report, search and claim lost items efficiently. Features include item categorization, image uploads and user authentication. 

This portal lets students create, retrive, update, search and delete their posts made by them and others. 

Features included for students-
- Creating posts for lost items and found items.
- viewing the status of their posts in their profile.
- viewing and searching posts category-wise made by other students.

Features included for admin-
- managing users and creating new users.
- viewing all the posts made by students and managing the posts which have been claimed and deleting the unnecessary or unwanted posts.

  SQL Database Format:

CREATE DATABASE IF NOT EXISTS lostfound;
USE lostfound;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    registered_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE items (
    GID INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(10),
    usn VARCHAR(30),
    contact VARCHAR(20),
    email VARCHAR(100),
    itemname VARCHAR(100),
    category VARCHAR(50),
    description TEXT,
    imgpath VARCHAR(255),
    addet TEXT,
    status VARCHAR(20) DEFAULT 'Unclaimed',
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE founditems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    USN VARCHAR(30),
    Dept VARCHAR(50),
    Contact VARCHAR(20),
    Email VARCHAR(100),
    itemname VARCHAR(100),
    category VARCHAR(50),
    Description TEXT,
    imgpath VARCHAR(255),
    addet TEXT,
    status VARCHAR(20) DEFAULT 'unclaimed'
);

CREATE TABLE lostitems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    USN VARCHAR(30),
    Dept VARCHAR(50),
    Contact VARCHAR(20),
    Email VARCHAR(100),
    itemname VARCHAR(100),
    category VARCHAR(50),
    Description TEXT,
    imgpath VARCHAR(255),
    addet TEXT
);


  Author : ShakaByte
