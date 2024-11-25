const mysql = require("mysql2");

const db = mysql.createConnection({
    host: "localhost",
    user: "root",      // Your MySQL username
    password: "H@rshal78",  // Your MySQL password
    database: "vitresults1",    // Your database name
});

db.connect((err) => {
    if (err) {
        console.error("Error connecting to MySQL:", err);
        return;
    }
    console.log("Connected to MySQL Database");
});

module.exports = db;
