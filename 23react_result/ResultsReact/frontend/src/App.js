import React from "react";
import AddResult from "./components/AddResult";
import ResultList from "./components/ResultList";

function App() {
    return (
        <div className="App">
            <h1>VIT Semester Results</h1>
            <AddResult />
            <ResultList />
        </div>
    );
}

export default App;
