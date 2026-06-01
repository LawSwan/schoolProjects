const express = require('express');
const app = express();
 
const bookRoute = express.Router();
let Book = require('../model/Book');
 
// Get all Books
bookRoute.route('/').get((req, res) => {
    Book.find().then((response) => {
      res.status(200).json(response);
    })
    .catch((error) => {
      console.error(`Could not get books: ${error}`);
  })
})

// Add a book
bookRoute.route('/add-book').post((req, res) => {
  Book.create(req.body).then((response) => {
    console.log('Book added successfully.');
    res.status(201).json(response);
  })
  .catch((error) => {
    console.error(`Could not save book: ${error}`);
    res.status(500).json({ message: 'Could not save book' });
  })
})

module.exports = bookRoute;