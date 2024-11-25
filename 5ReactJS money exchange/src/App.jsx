import { useState } from 'react';
import './App.css';

function App() {
  const [dollars, setDollars] = useState('');
  const [rupees, setRupees] = useState(null);

  const convertCurrency = () => {
   
    const conversionRate = 83;
    const result = parseFloat(dollars) * conversionRate;
    setRupees(result.toFixed(2));
  };

  return (
    <div className="app-container">
      <h1>Dollar to Indian Rupee Converter</h1>
      <div className="input-container">
        <input
          type="number"
          value={dollars}
          onChange={(e) => setDollars(e.target.value)}
          placeholder="Enter amount in dollars"
        />
        <button onClick={convertCurrency}>Convert</button>
      </div>
      {rupees !== null && (
        <div className="result">
          <h2>
            ₹ {rupees} INR
          </h2>
        </div>
      )}
    </div>
  );
}

export default App;
