// const mysql = require("mysql");
const mysql = require("mysql2");
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "H@rshal78", 
  database: "bookstore"
});

db.connect((err) => {
  if (err) {
    console.error("Error connecting to database:", err.message);
    return;
  }
  console.log("Connected to MySQL database.");
});

module.exports = db;
