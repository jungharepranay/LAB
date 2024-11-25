import React, { useState } from "react";
import { useNavigate } from "react-router-dom"; // Use useNavigate in v6
import "./LoginStu.css";

function LoginStu() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate(); // Use useNavigate hook for navigation

  // Hardcoded username and password
  const hardcodedUsername = "harshal";
  const hardcodedPassword = "1234";

  // Handle form submission
  const handleSubmit = (e) => {
    e.preventDefault();

    // Check if username and password match the hardcoded values
    if (username === hardcodedUsername && password === hardcodedPassword) {
      // Redirect to the complaints page using navigate
      navigate("/complaints");
    } else {
      // Display error message if credentials are incorrect
      setError("Invalid username or password");
    }
  };

  // Handle redirect to admin login
  const handleAdminLoginRedirect = () => {
    navigate("/adminlogin"); // Navigate to the Admin Login page
  };

  return (
    <div className="login-container">
      <h2 className="login-heading">Student Login</h2>
      <form className="login-form" onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Username"
          className="login-input"
          value={username}
          onChange={(e) => setUsername(e.target.value)}
          required
        />
        <input
          type="password"
          placeholder="Password"
          className="login-input"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        <button type="submit" className="login-button">
          Login
        </button>
        {error && <div className="error-message">{error}</div>}
      </form>

      <button
        type="button"
        className="redirect-button"
        onClick={handleAdminLoginRedirect}
      >
        Admin Login
      </button>
    </div>
  );
}

export default LoginStu;
