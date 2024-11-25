Create new folder "session_expire"

---------------------------------------

add it in C:\xampp\htdocs

open in vs

---------------------------------------

Open Xampp Control Panel 
start apache n mysql
click on admin button in front of mysql 
----------------------------------------
in the php admin page:
click new to create database:
Give name as session
---------------------------------------
In that page click on SQL
and add following script:
---------------------------------------

-- Table for storing user information
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Table for storing active user sessions
CREATE TABLE user_sessions (
    session_id VARCHAR(255) PRIMARY KEY,
    user_id INT NOT NULL,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

---------------------------------------------------------------------

click go

---------------------------------------------------------------------

Run in the browser :

http://localhost:8080/session_expire/register.php

---------------------------------------------------------------------

In new tab again open login.php and log in 
do this total 3 TIMES
during 4th time , it will show u have reached max. limit

---------------------------------------------------------------------
