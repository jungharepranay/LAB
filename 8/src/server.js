import express from "express";
import mysql2 from  "mysql2";
import cors from "cors";
import bodyParser from 'body-parser';

const app = express();
const PORT = 5000;

// Middleware
app.use(cors());
app.use(express.json());


app.use(bodyParser.json());

// MySQL Connection

const db = mysql2.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'H@rshal78',
  database: 'wtlab',
});

db.connect((err) => {
  if (err) {
    console.error("Error connecting to database:", err);
  } else {
    console.log("Connected to MySQL database.");
  }
});

// API to handle complaints submission
app.post("/complaints", (req, res) => {
  const { prn, name, branch, complaint } = req.body;

  if (!prn || !name || !branch || !complaint) {
    return res.status(400).json({ message: "All fields are required." });
  }

  const sql = "INSERT INTO complaints (prn, name, branch, complaint) VALUES (?, ?, ?, ?)";
  db.query(sql, [prn, name, branch, complaint], (err, result) => {
    if (err) {
      console.error(err);
      return res.status(500).json({ message: "Error saving complaint." });
    }
    res.status(200).json({ message: "Complaint submitted successfully!" });
  });
});

app.get("/complaints", (req, res) => {
    const sql = "SELECT * FROM complaints";
    db.query(sql, (err, results) => {
      if (err) {
        console.error("Error fetching complaints:", err);
        return res.status(500).json({ message: "Error retrieving complaints." });
      }
      res.status(200).json(results);
    });
  });

// Start Server

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
