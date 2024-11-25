Create a React app using npx create-react-app student-login.

Install dependencies for the backend:
npm install express mysql cors

Start the backend server:
node server.js

Start your React frontend.
npm run dev


database

DESCRIBE complaints;

create database wtlab;
use wtlab;
CREATE TABLE complaints (
  id INT AUTO_INCREMENT PRIMARY KEY,
  prn VARCHAR(15) NOT NULL,
  name VARCHAR(100) NOT NULL,
  branch VARCHAR(100) NOT NULL,
  complaint TEXT NOT NULL
);
