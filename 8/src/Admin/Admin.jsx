import React, { useEffect, useState } from "react";
import axios from "axios";
import "./Admin.css"

const AdminComplaints = () => {
  const [complaints, setComplaints] = useState([]);

  // Fetch complaints from the server
  useEffect(() => {
    axios
      .get("http://localhost:5000/complaints")
      .then((response) => {
        setComplaints(response.data);
      })
      .catch((error) => {
        console.error("Error fetching complaints:", error);
      });
  }, []);

  return (
    <div style={{ padding: "20px" }}>
      <h1>Admin - Complaints</h1>
      <table style={{ width: "100%", borderCollapse: "collapse" }}>
        <thead>
          <tr>
            <th style={{ border: "1px solid black", padding: "8px" }}>PRN</th>
            <th style={{ border: "1px solid black", padding: "8px" }}>Name</th>
            <th style={{ border: "1px solid black", padding: "8px" }}>Branch</th>
            <th style={{ border: "1px solid black", padding: "8px" }}>Complaint</th>
          </tr>
        </thead>
        <tbody>
          {complaints.length > 0 ? (
            complaints.map((complaint, index) => (
              <tr key={index}>
                <td style={{ border: "1px solid black", padding: "8px" }}>{complaint.prn}</td>
                <td style={{ border: "1px solid black", padding: "8px" }}>{complaint.name}</td>
                <td style={{ border: "1px solid black", padding: "8px" }}>{complaint.branch}</td>
                <td style={{ border: "1px solid black", padding: "8px" }}>{complaint.complaint}</td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="4" style={{ textAlign: "center", padding: "8px" }}>
                No complaints found.
              </td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
};

export default AdminComplaints;
