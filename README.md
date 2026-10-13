# 🔍 Lost-Found-Portal-College

A web-based Lost and Found portal for college campuses, built as a 2nd-year mini project for the Database Management Systems course.

## 📌 Overview

Students can report lost or found items, search posts by category, and track the status of their own posts. Admins manage users and moderate posts, including marking items as claimed and removing unwanted posts.

## ❗ Problem Statement

Lost items on campus are usually reported through word of mouth, notice boards, or group chats.
- Posts get buried and are hard to search
- No record of whether an item was claimed
- No way to categorize or filter items
- No moderation of old or irrelevant posts

## ✅ Solution

A centralized portal with user authentication, categorized posts, image uploads, and claim tracking.

**Student features**
- Create lost and found posts with images
- View the status of their own posts in their profile
- Search and browse other students' posts by category
- Update and delete their own posts

**Admin features**
- Create and manage users
- View all posts and mark claimed items
- Delete unnecessary or unwanted posts

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML, CSS, [JavaScript] |
| Backend | PHP |
| Database | MySQL |

## 🗄️ Database Schema

Four tables:

| Table | Purpose |
|-------|---------|
| `users` | Accounts with name, email, password and role |
| `items` | Posts with type, category, description, image path and claim status |
| `founditems` | Details of found items reported by students |
| `lostitems` | Details of lost items reported by students |

<details>
<summary>View full SQL schema</summary>

```sql
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
```
