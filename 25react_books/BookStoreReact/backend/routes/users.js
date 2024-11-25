const express = require("express");
const { createUser, authenticateUser } = require("../models/User");

const router = express.Router();

// User Registration
router.post("/register", (req, res) => {
  const { username, password } = req.body;

  createUser(username, password, (err) => {
    if (err) {
      if (err.code === "ER_DUP_ENTRY") {
        res.status(400).send({ message: "Username already exists" });
      } else {
        res.status(500).send({ message: "Server error" });
      }
    } else {
      res.send({ message: "User registered successfully" });
    }
  });
});

// User Login
router.post("/login", (req, res) => {
  const { username, password } = req.body;

  authenticateUser(username, password, (err, user) => {
    if (err) {
      res.status(400).send({ message: err });
    } else {
      res.send({ message: "Login successful", user });
    }
  });
});

module.exports = router;
