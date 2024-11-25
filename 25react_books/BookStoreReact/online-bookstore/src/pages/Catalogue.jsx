import React, { useEffect, useState } from "react";
import axios from "axios";

const Catalogue = () => {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    const fetchBooks = async () => {
      try {
        const response = await axios.get("http://localhost:5000/books");
        setBooks(response.data);
      } catch (error) {
        console.error("Error fetching books:", error);
      }
    };
    fetchBooks();
  }, []);

  return (
    <div>
      <h2>Book Catalogue</h2>
      <ul>
        {books.map((book) => (
          <li key={book.id}>
            <strong>{book.title}</strong> by {book.author} - ${book.price}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Catalogue;
