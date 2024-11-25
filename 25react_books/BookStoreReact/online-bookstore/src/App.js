import React from "react";
import { Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import Login from "./pages/Login";
import Catalogue from "./pages/Catalogue";
import Registration from "./pages/Registration";
import AddBook from "./pages/AddBook";
import './App.css';


const App = () => {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/login" element={<Login />} />
      <Route path="/catalogue" element={<Catalogue />} />
      <Route path="/register" element={<Registration />} />
      <Route path="/addbook" element={<AddBook />} />
    </Routes>
  );
};

export default App;
