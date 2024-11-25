import React from "react";
import StudentForm from "./components/StudentForm";
import StudentList from "./components/StudentList";
import "./App.css";

function App() {
  return (
    <div className="App">
      <header>
        <h1>VIT Results Management</h1>
      </header>
      <main>
        <div className="column">
          <StudentForm />
        </div>
        <div className="column">
          <StudentList />
        </div>
      </main>
    </div>
  );
}

export default App;
