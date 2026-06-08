const express = require('express');
const itemRoutes = require('./routes/items.routes');

const app = express();

app.use(express.json());
app.use('/api/items', itemRoutes);

app.use((err, req, res, next) => {
  res.status(500).json({
    message: 'Internal server error',
    error: err.message,
  });
});

module.exports = app;
