import React, { useState } from "react";
import axios from "axios";
import "./Complaints.css";

function Complaints() {
  const [formData, setFormData] = useState({
    prn: "",
    name: "",
    branch: "",
    complaint: "",
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("http://localhost:5000/complaints", formData);
      alert(response.data.message);
      setFormData({ prn: "", name: "", branch: "", complaint: "" });
    } catch (error) {
      console.error(error);
      alert("Error submitting complaint. Please try again.");
    }
  };

  return (
    <div className="complaints-container">
      <h2 className="complaints-heading">Student Complaint Form</h2>
      <form className="complaints-form" onSubmit={handleSubmit}>
        <input
          type="text"
          name="prn"
          placeholder="Student PRN"
          value={formData.prn}
          onChange={handleChange}
          className="complaints-input"
          required
        />
        <input
          type="text"
          name="name"
          placeholder="Student Name"
          value={formData.name}
          onChange={handleChange}
          className="complaints-input"
          required
        />
        <input
          type="text"
          name="branch"
          placeholder="Student Branch"
          value={formData.branch}
          onChange={handleChange}
          className="complaints-input"
          required
        />
        <textarea
          name="complaint"
          placeholder="Complaint"
          value={formData.complaint}
          onChange={handleChange}
          className="complaints-textarea"
          required
        ></textarea>
        <button type="submit" className="complaints-button">
          Submit
        </button>
      </form>
    </div>
  );
}

export default Complaints;
