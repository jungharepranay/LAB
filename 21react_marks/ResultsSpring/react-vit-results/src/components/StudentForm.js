import React, { useState } from "react";
import axios from "axios";

const StudentForm = () => {
  const [student, setStudent] = useState({
    name: "",
    rollNo: "",
    subject1Mse: "",
    subject1Ese: "",
    subject2Mse: "",
    subject2Ese: "",
    subject3Mse: "",
    subject3Ese: "",
    subject4Mse: "",
    subject4Ese: "",
  });

  const handleChange = (e) => {
    setStudent({ ...student, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    axios
      .post("http://localhost:8080/api/students", student, {
        headers: { "Content-Type": "application/json" },
      })
      .then((response) => {
        alert("Student added successfully!");
        setStudent({
          name: "",
          rollNo: "",
          subject1Mse: "",
          subject1Ese: "",
          subject2Mse: "",
          subject2Ese: "",
          subject3Mse: "",
          subject3Ese: "",
          subject4Mse: "",
          subject4Ese: "",
        });
      })
      .catch((error) => {
        console.error("Error adding student:", error);
      });
  };

  return (
    <form onSubmit={handleSubmit} className="student-form">
      <h2>Add Student</h2>
      <input
        type="text"
        name="name"
        placeholder="Name"
        value={student.name}
        onChange={handleChange}
        required
      />
      <input
        type="text"
        name="rollNo"
        placeholder="Roll No"
        value={student.rollNo}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject1Mse"
        placeholder="Subject 1 MSE"
        value={student.subject1Mse}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject1Ese"
        placeholder="Subject 1 ESE"
        value={student.subject1Ese}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject2Mse"
        placeholder="Subject 2 MSE"
        value={student.subject2Mse}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject2Ese"
        placeholder="Subject 2 ESE"
        value={student.subject2Ese}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject3Mse"
        placeholder="Subject 3 MSE"
        value={student.subject3Mse}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject3Ese"
        placeholder="Subject 3 ESE"
        value={student.subject3Ese}
        onChange={handleChange}
        required
      />
      {/* Repeat for other subjects */}
      <input
        type="number"
        name="subject4Mse"
        placeholder="Subject 4 MSE"
        value={student.subject4Mse}
        onChange={handleChange}
        required
      />
      <input
        type="number"
        name="subject4Ese"
        placeholder="Subject 4 ESE"
        value={student.subject4Ese}
        onChange={handleChange}
        required
      />
      <button type="submit">Add Student</button>
    </form>
  );
};

export default StudentForm;
