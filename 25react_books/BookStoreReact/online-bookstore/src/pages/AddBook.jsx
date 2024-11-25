import React, { useState } from "react";
import axios from "axios";

const AddBook = () => {
  const [bookData, setBookData] = useState({
    title: "",
    author: "",
    price: "",
    category: "",
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setBookData({ ...bookData, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("http://localhost:5000/books/add", bookData);
      alert(response.data.message);
    } catch (error) {
      console.error("Error adding book:", error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Add New Book</h2>
      <input
        type="text"
        name="title"
        placeholder="Title"
        value={bookData.title}
        onChange={handleChange}
      />
      <input
        type="text"
        name="author"
        placeholder="Author"
        value={bookData.author}
        onChange={handleChange}
      />
      <input
        type="number"
        name="price"
        placeholder="Price"
        value={bookData.price}
        onChange={handleChange}
      />
      <input
        type="text"
        name="category"
        placeholder="Category"
        value={bookData.category}
        onChange={handleChange}
      />
      <button type="submit">Add Book</button>
    </form>
  );
};

export default AddBook;
