import React, { useState, useEffect } from "react";
import axios from "axios";
import "./styles.css";

function ResultList() {
    const [results, setResults] = useState([]);

    useEffect(() => {
        const fetchResults = async () => {
            try {
                const response = await axios.get("http://localhost:5000/api/students");
                setResults(response.data);
            } catch (error) {
                console.error("Error fetching results:", error);
            }
        };
        fetchResults();
    }, []);

    return (
        <div className="results-container">
            <h2 className="results-title">Student Results</h2>
            {results.length === 0 ? (
                <p className="no-results">No results found.</p>
            ) : (
                <table className="results-table">
                    <thead>
                        <tr>
                            <th>Roll Number</th>
                            <th>Name</th>
                            <th>Subject 1 Total</th>
                            <th>Subject 2 Total</th>
                            <th>Subject 3 Total</th>
                            <th>Subject 4 Total</th>
                            <th>Total Marks</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        {results.map((result, index) => (
                            <tr key={index}>
                                <td>{result.roll_number}</td>
                                <td>{result.name}</td>
                                <td>{(result.subject1_mse * 0.3 + result.subject1_ese * 0.7).toFixed(2)}</td>
                                <td>{(result.subject2_mse * 0.3 + result.subject2_ese * 0.7).toFixed(2)}</td>
                                <td>{(result.subject3_mse * 0.3 + result.subject3_ese * 0.7).toFixed(2)}</td>
                                <td>{(result.subject4_mse * 0.3 + result.subject4_ese * 0.7).toFixed(2)}</td>
                                <td>{result.total_marks.toFixed(2)}</td>
                                <td>{result.percentage.toFixed(2)}%</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
}

export default ResultList;
