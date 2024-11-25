import React from "react";
import { Link } from "react-router-dom";

const Header = () => {
  return (
    <header>
      <h1>Online Bookstore</h1>
      <nav>
        <Link to="/">Home</Link>
        <Link to="/login">Login</Link>
        <Link to="/catalogue">Catalogue</Link>
        <Link to="/register">Register</Link>
      </nav>
    </header>
  );
};

export default Header;
