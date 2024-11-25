import { useState } from 'react'
import './App.css'
import { BrowserRouter as Router, Route, Routes } from "react-router-dom"; // Import BrowserRouter as Router
import LoginStu from './StudentLogin/LoginStu'
import Complaints from './Complaints/Complaints'
import AdminComp from './Admin/Admin'
import AdminLog from "./LoginAdmin/LoginAd"

function App() {
  

  return (
    <Router>
      <Routes>
        <Route path="/" element={<LoginStu />} />
        <Route path="/complaints" element={<Complaints />} />
        <Route path="/Admin" element={<AdminComp />} />
        <Route path="/AdminLogin" element={<AdminLog />} />
      </Routes>
    </Router>
  )
}

export default App
