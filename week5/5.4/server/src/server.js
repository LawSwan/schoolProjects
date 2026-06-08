const express = require('express');
const cors = require('cors');
const mongoose = require('mongoose');

const CensusRecord = require('./models/CensusRecord');

const app = express();
const port = process.env.PORT || 3000;
const mongoUri = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/census_app';

app.use(cors());
app.use(express.json());

app.get('/api/health', (_request, response) => {
  response.json({ status: 'ok' });
});

app.get('/api/census', async (_request, response) => {
  try {
    const records = await CensusRecord.find().sort({ year: -1, createdAt: -1 });
    response.json(records);
  } catch (error) {
    response.status(500).json({ message: error.message || 'Unable to fetch records.' });
  }
});

app.post('/api/census', async (request, response) => {
  try {
    const record = await CensusRecord.create(request.body);
    response.status(201).json(record);
  } catch (error) {
    response.status(400).json({ message: error.message || 'Unable to create record.' });
  }
});

app.put('/api/census/:id', async (request, response) => {
  try {
    const record = await CensusRecord.findByIdAndUpdate(request.params.id, request.body, {
      returnDocument: 'after',
      runValidators: true
    });

    if (!record) {
      response.status(404).json({ message: 'Record not found.' });
      return;
    }

    response.json(record);
  } catch (error) {
    response.status(400).json({ message: error.message || 'Unable to update record.' });
  }
});

app.delete('/api/census/:id', async (request, response) => {
  try {
    const record = await CensusRecord.findByIdAndDelete(request.params.id);

    if (!record) {
      response.status(404).json({ message: 'Record not found.' });
      return;
    }

    response.status(204).send();
  } catch (error) {
    response.status(400).json({ message: error.message || 'Unable to delete record.' });
  }
});

async function startServer() {
  try {
    await mongoose.connect(mongoUri);
    app.listen(port, () => {
      console.log(`Server listening on port ${port}`);
    });
  } catch (error) {
    console.error('Failed to connect to MongoDB.', error);
    process.exit(1);
  }
}

startServer();
