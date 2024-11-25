import React, { useEffect, useState } from "react";
import axios from "axios";

const StudentList = () => {
  const [students, setStudents] = useState([]);

  useEffect(() => {
    axios
      .get("http://localhost:8080/api/students")
      .then((response) => {
        setStudents(response.data);
      })
      .catch((error) => {
        console.error("Error fetching students:", error);
      });
  }, []);

  return (
    <div className="student-list">
      <h2>Student Results</h2>
      <table>
        <thead>
          <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Subject 1 Total</th>
            <th>Subject 2 Total</th>
            <th>Subject 3 Total</th>
            <th>Subject 4 Total</th>
          </tr>
        </thead>
        <tbody>
          {students.map((student) => (
            <tr key={student.id}>
              <td>{student.rollNo}</td>
              <td>{student.name}</td>
              <td>{(student.subject1Mse * 0.3 + student.subject1Ese * 0.7).toFixed(2)}</td>
              <td>{(student.subject2Mse * 0.3 + student.subject2Ese * 0.7).toFixed(2)}</td>
              <td>{(student.subject3Mse * 0.3 + student.subject3Ese * 0.7).toFixed(2)}</td>
              <td>{(student.subject4Mse * 0.3 + student.subject4Ese * 0.7).toFixed(2)}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default StudentList;
