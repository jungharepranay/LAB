const bcrypt = require("bcrypt");
const db = require("../db");

// Register a new user
const createUser = (username, password, callback) => {
  const hash = bcrypt.hashSync(password, 10); // Hash the password
  const query = "INSERT INTO users (username, password) VALUES (?, ?)";
  db.query(query, [username, hash], callback);
};

// Authenticate user during login
const authenticateUser = (username, password, callback) => {
  const query = "SELECT * FROM users WHERE username = ?";
  db.query(query, [username], (err, results) => {
    if (err || results.length === 0) {
      return callback("Invalid username or password");
    }

    const user = results[0];
    const isMatch = bcrypt.compareSync(password, user.password);

    if (isMatch) {
      callback(null, user);
    } else {
      callback("Invalid username or password");
    }
  });
};

module.exports = { createUser, authenticateUser };
