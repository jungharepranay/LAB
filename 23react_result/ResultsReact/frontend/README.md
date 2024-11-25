In mysql create 


CREATE DATABASE vitresults1;

USE vitresults1;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_number VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(50) NOT NULL,
    subject1_mse FLOAT NOT NULL,
    subject1_ese FLOAT NOT NULL,
    subject2_mse FLOAT NOT NULL,
    subject2_ese FLOAT NOT NULL,
    subject3_mse FLOAT NOT NULL,
    subject3_ese FLOAT NOT NULL,
    subject4_mse FLOAT NOT NULL,
    subject4_ese FLOAT NOT NULL,
    total_marks FLOAT NOT NULL,
    percentage FLOAT NOT NULL
);


go in backend and do node server.js
change password in db.js

run node server.js

for frontend go in online-bookstore and do npm start