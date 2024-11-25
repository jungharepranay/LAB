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
            <th>Overall Percentage</th>
          </tr>
        </thead>
        <tbody>
          {students.map((student) => {
            // Calculate total marks for each subject
            const subject1Total = student.subject1Mse * 0.3 + student.subject1Ese * 0.7;
            const subject2Total = student.subject2Mse * 0.3 + student.subject2Ese * 0.7;
            const subject3Total = student.subject3Mse * 0.3 + student.subject3Ese * 0.7;
            const subject4Total = student.subject4Mse * 0.3 + student.subject4Ese * 0.7;

            // Calculate overall percentage
            const overallPercentage =
              ((subject1Total + subject2Total + subject3Total + subject4Total) / 4).toFixed(2);

            return (
              <tr key={student.id}>
                <td>{student.rollNo}</td>
                <td>{student.name}</td>
                <td>{subject1Total.toFixed(2)}</td>
                <td>{subject2Total.toFixed(2)}</td>
                <td>{subject3Total.toFixed(2)}</td>
                <td>{subject4Total.toFixed(2)}</td>
                <td>{overallPercentage}%</td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
};

export default StudentList;