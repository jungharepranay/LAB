import React from "react";
import { useNavigate } from "react-router-dom";

const Home = () => {
  const navigate = useNavigate(); // Hook to navigate programmatically

  return (
    <div style={{ textAlign: "center", marginTop: "50px" }}>
      <h1>Welcome to the Online Bookstore</h1>
      <p>Explore a variety of books at amazing prices!</p>

      <div style={{ marginTop: "30px" }}>
        <button
          style={{ margin: "10px", padding: "10px 20px" }}
          onClick={() => navigate("/login")}
        >
          Login
        </button>
        <button
          style={{ margin: "10px", padding: "10px 20px" }}
          onClick={() => navigate("/register")}
        >
          Register
        </button>
        <button
          style={{ margin: "10px", padding: "10px 20px" }}
          onClick={() => navigate("/catalogue")}
        >
          View Catalogue
        </button>
        <button
          style={{ margin: "10px", padding: "10px 20px" }}
          onClick={() => navigate("/addbook")}
        >
          Add a Book
        </button>
      </div>
    </div>
  );
};

export default Home;
