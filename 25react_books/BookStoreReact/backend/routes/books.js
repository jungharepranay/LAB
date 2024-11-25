const express = require("express");
const { getAllBooks, addBook } = require("../models/Book");

const router = express.Router();

// Fetch all books
router.get("/", (req, res) => {
  getAllBooks((err, results) => {
    if (err) {
      res.status(500).send({ message: "Error fetching books" });
    } else {
      res.send(results);
    }
  });
});

// Add a new book (Admin functionality)
router.post("/add", (req, res) => {
  const { title, author, price, category } = req.body;

  addBook(title, author, price, category, (err) => {
    if (err) {
      res.status(500).send({ message: "Error adding book" });
    } else {
      res.send({ message: "Book added successfully" });
    }
  });
});

module.exports = router;
