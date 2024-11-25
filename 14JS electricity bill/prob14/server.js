const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: true }));

function calculateBill(units) {
    let bill = 0;
    if (units > 250) {
        bill += (units - 250) * 6.5;
        units = 250;
    }
    if (units > 150) {
        bill += (units - 150) * 5.2;
        units = 150;
    }
    if (units > 50) {
        bill += (units - 50) * 4.0;
        units = 50;
    }
    bill += units * 3.5;
    return bill.toFixed(2);
}

app.post('/calculate', (req, res) => {
    const units = parseFloat(req.body.units);
    if (isNaN(units) || units < 0) {
        res.send({ error: 'Please enter a valid number of units!' });
    } else {
        const bill = calculateBill(units);
        res.send({ bill });
    }
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running at http://localhost:${PORT}`);
});
