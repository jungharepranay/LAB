const db = require("../db");

// Fetch all books
const getAllBooks = (callback) => {
  const query = "SELECT * FROM books";
  db.query(query, callback);
};

// Add a new book (Admin functionality)
const addBook = (title, author, price, category, callback) => {
  const query = "INSERT INTO books (title, author, price, category) VALUES (?, ?, ?, ?)";
  db.query(query, [title, author, price, category], callback);
};

module.exports = { getAllBooks, addBook };
