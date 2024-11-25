const express = require("express");
const db = require("../db/db"); // Assuming db.js handles MySQL connection

const router = express.Router();

// Function to calculate total marks for a subject
const calculateSubjectTotal = (mse, ese) => {
    const mseWeighted = mse * 0.3;
    const eseWeighted = ese * 0.7;
    const subjectTotal = mseWeighted + eseWeighted;

    // Debugging logs
    console.log(`MSE: ${mse}, ESE: ${ese}, MSE (30%): ${mseWeighted}, ESE (70%): ${eseWeighted}, Subject Total: ${subjectTotal}`);
    return subjectTotal;
};

// Route to add a student's result
router.post("/", (req, res) => {
    const {
        roll_number,
        name,
        subject1_mse,
        subject1_ese,
        subject2_mse,
        subject2_ese,
        subject3_mse,
        subject3_ese,
        subject4_mse,
        subject4_ese,
    } = req.body;

    // Validation for roll number and name
    if (!roll_number || !name) {
        return res.status(400).json({ error: "Roll number and name are required" });
    }

    // Validation for marks
    const marks = [
        subject1_mse,
        subject1_ese,
        subject2_mse,
        subject2_ese,
        subject3_mse,
        subject3_ese,
        subject4_mse,
        subject4_ese,
    ];

    if (marks.some((mark) => mark === undefined || mark === null || isNaN(mark))) {
        return res.status(400).json({ error: "All marks must be numbers" });
    }

    if (marks.some((mark) => mark < 0 || mark > 100)) {
        return res.status(400).json({ error: "Marks must be between 0 and 100" });
    }

    // Calculate total marks for each subject
    const subject1_total = calculateSubjectTotal(subject1_mse, subject1_ese);
    const subject2_total = calculateSubjectTotal(subject2_mse, subject2_ese);
    const subject3_total = calculateSubjectTotal(subject3_mse, subject3_ese);
    const subject4_total = calculateSubjectTotal(subject4_mse, subject4_ese);

    // Calculate overall total marks and percentage
    const total_marks = subject1_total + subject2_total + subject3_total + subject4_total;
    const percentage = (total_marks / 400) * 100;

    // Debugging logs for totals and percentage
    console.log({
        subject1_total,
        subject2_total,
        subject3_total,
        subject4_total,
        total_marks,
        percentage,
    });

    // Insert data into the database
    const query =
        "INSERT INTO students (roll_number, name, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese, total_marks, percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    db.query(
        query,
        [
            roll_number,
            name,
            subject1_mse,
            subject1_ese,
            subject2_mse,
            subject2_ese,
            subject3_mse,
            subject3_ese,
            subject4_mse,
            subject4_ese,
            total_marks,
            percentage,
        ],
        (err, result) => {
            if (err) {
                console.error("Error inserting data into database:", err);
                return res.status(500).json({ error: "Failed to add result" });
            }
            res.status(200).json({ message: "Result added successfully!" });
        }
    );
});

// Route to fetch all student results
router.get("/", (req, res) => {
    const query = "SELECT * FROM students";

    db.query(query, (err, results) => {
        if (err) {
            console.error("Error fetching results from database:", err);
            return res.status(500).json({ error: "Failed to fetch results" });
        }
        res.status(200).json(results);
    });
});

module.exports = router;
