import React, { useState } from "react";
import axios from "axios";
import "./styles.css";

function AddResult() {
    const [form, setForm] = useState({
        roll_number: "",
        name: "",
        subject1_mse: "",
        subject1_ese: "",
        subject2_mse: "",
        subject2_ese: "",
        subject3_mse: "",
        subject3_ese: "",
        subject4_mse: "",
        subject4_ese: "",
    });

    const [errors, setErrors] = useState("");

    const validateMarks = (mse, ese) => {
        if (isNaN(mse) || isNaN(ese)) return "Marks should be numbers.";
        if (mse < 0 || mse > 100 || ese < 0 || ese > 100) {
            return "Marks should be between 0 and 100.";
        }
        return null;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        for (let i = 1; i <= 4; i++) {
            const mse = form[`subject${i}_mse`];
            const ese = form[`subject${i}_ese`];
            const error = validateMarks(mse, ese);
            if (error) {
                setErrors(error);
                return;
            }
        }

        const payload = {
            ...form,
            subject1_total: form.subject1_mse * 0.3 + form.subject1_ese * 0.7,
            subject2_total: form.subject2_mse * 0.3 + form.subject2_ese * 0.7,
            subject3_total: form.subject3_mse * 0.3 + form.subject3_ese * 0.7,
            subject4_total: form.subject4_mse * 0.3 + form.subject4_ese * 0.7,
        };

        try {
            await axios.post("http://localhost:5000/api/students", payload);
            alert("Result added successfully!");
            setForm({
                roll_number: "",
                name: "",
                subject1_mse: "",
                subject1_ese: "",
                subject2_mse: "",
                subject2_ese: "",
                subject3_mse: "",
                subject3_ese: "",
                subject4_mse: "",
                subject4_ese: "",
            });
        } catch (err) {
            console.error(err);
            alert("Error adding result");
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setForm({ ...form, [name]: value });
    };

    return (
        <form onSubmit={handleSubmit} className="form-container">
            <h2 className="form-title">Add Student Results</h2>
            {errors && <p className="error-message">{errors}</p>}

            <div className="form-grid">
                {/* Left Column */}
                <div className="form-left">
                    <label htmlFor="roll_number">Roll Number</label>
                    <input
                        type="text"
                        id="roll_number"
                        name="roll_number"
                        placeholder="Enter Roll Number"
                        value={form.roll_number}
                        onChange={handleChange}
                        required
                    />

                    <label htmlFor="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter Name"
                        value={form.name}
                        onChange={handleChange}
                        required
                    />
                </div>

                {/* Right Column */}
                <div className="form-right">
                    {[...Array(4)].map((_, index) => (
                        <div key={index} className="subject-container">
                            <label>Subject {index + 1} Marks</label>
                            <input
                                type="number"
                                name={`subject${index + 1}_mse`}
                                placeholder="MSE (out of 100)"
                                value={form[`subject${index + 1}_mse`]}
                                onChange={handleChange}
                                required
                            />
                            <input
                                type="number"
                                name={`subject${index + 1}_ese`}
                                placeholder="ESE (out of 100)"
                                value={form[`subject${index + 1}_ese`]}
                                onChange={handleChange}
                                required
                            />
                        </div>
                    ))}
                </div>
            </div>

            <button type="submit" className="submit-btn">
                Add Result
            </button>
        </form>
    );
}

export default AddResult;
