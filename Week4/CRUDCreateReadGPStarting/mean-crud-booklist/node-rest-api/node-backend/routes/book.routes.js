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

// Get a single book by id
bookRoute.route('/read-book/:id').get((req, res) => {
  Book.findById(req.params.id).then((response) => {
    res.status(200).json(response);
  })
  .catch((error) => {
    console.error(`Could not get book: ${error}`);
    res.status(500).json({ message: 'Could not get book' });
  })
})

// Update a book
bookRoute.route('/update-book/:id').put((req, res) => {
  console.log(`Preparing to update: ${req.params.id}`);
  Book.findByIdAndUpdate(req.params.id, { $set: req.body }, { new: true }).then((response) => {
    console.log('Book updated successfully.');
    res.status(200).json(response);
  })
  .catch((error) => {
    console.error(`Could not update book: ${error}`);
    res.status(500).json({ message: 'Could not update book' });
  })
})

// Delete a book
bookRoute.route('/delete-book/:id').delete((req, res) => {
  console.log(`Preparing to delete: ${req.params.id}`);
  Book.findByIdAndDelete(req.params.id).then((response) => {
    console.log('Book deleted successfully.');
    res.status(200).json(response);
  })
  .catch((error) => {
    console.error(`Could not delete book: ${error}`);
    res.status(500).json({ message: 'Could not delete book' });
  })
})

module.exports = bookRoute;