const mongoose = require('mongoose');

const censusRecordSchema = new mongoose.Schema(
  {
    householdSize: {
      type: Number,
      required: true,
      min: 1
    },
    address: {
      street: {
        type: String,
        required: true,
        trim: true
      },
      city: {
        type: String,
        required: true,
        trim: true
      },
      state: {
        type: String,
        required: true,
        trim: true
      },
      zipCode: {
        type: String,
        required: true,
        trim: true
      }
    },
    year: {
      type: Number,
      required: true
    },
    censusTakerName: {
      type: String,
      required: true,
      trim: true
    }
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model('CensusRecord', censusRecordSchema);
