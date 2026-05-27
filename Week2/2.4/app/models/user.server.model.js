const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const UserSchema = new Schema({
  firstName: {
    type: String,
    // Predefined modifier: trim leading/trailing whitespace
    trim: true,
    // Custom setter modifier: capitalize the first letter
    set(value) {
      if (!value) return value;
      return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
    }
  },
  lastName: {
    type: String,
    trim: true
  },
  email: {
    type: String,
    // Predefined modifier: store emails in lowercase
    lowercase: true,
    trim: true
  },
  username: {
    type: String,
    trim: true,
    // Defining a default value
    unique: true,
    required: 'Username is required'
  },
  password: {
    type: String
  },
  // Defining default values
  created: {
    type: Date,
    default: Date.now
  },
  website: {
    type: String,
    // Custom getter modifier: prepend "http://" when missing
    get(url) {
      if (!url) return url;
      if (url.indexOf('http://') !== 0 && url.indexOf('https://') !== 0) {
        return 'http://' + url;
      }
      return url;
    }
  }
});

// Ensure custom getters are applied when documents are converted to JSON / objects
UserSchema.set('toJSON', { getters: true });
UserSchema.set('toObject', { getters: true });

mongoose.model('User', UserSchema);
