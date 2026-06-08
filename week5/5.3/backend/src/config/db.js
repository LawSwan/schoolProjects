const mongoose = require('mongoose');

async function connectDB(uri) {
  if (!uri) {
    throw new Error('MongoDB connection URI is required');
  }
  return mongoose.connect(uri);
}

async function disconnectDB() {
  return mongoose.disconnect();
}

module.exports = {
  connectDB,
  disconnectDB,
};
