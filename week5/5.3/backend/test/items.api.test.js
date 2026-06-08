const request = require('supertest');
const should = require('should');
const mongoose = require('mongoose');
const { MongoMemoryServer } = require('mongodb-memory-server');

const app = require('../src/app');
const { connectDB, disconnectDB } = require('../src/config/db');
const Item = require('../src/models/item.model');

let mongoServer;

describe('Items API CRUD', () => {
  before(async () => {
    mongoServer = await MongoMemoryServer.create();
    process.env.MONGODB_TEST_URI = mongoServer.getUri();
    await connectDB(process.env.MONGODB_TEST_URI);
  });

  beforeEach(async () => {
    await Item.deleteMany({});
  });

  afterEach(async () => {
    await Item.deleteMany({});
  });

  after(async () => {
    await disconnectDB();
    await mongoServer.stop();
  });

  it('POST /api/items creates an item (happy path)', async () => {
    const payload = { name: 'Write tests', completed: false };

    const res = await request(app)
      .post('/api/items')
      .send(payload)
      .expect(201);

    res.body.should.have.property('_id');
    res.body.name.should.equal('Write tests');
    res.body.completed.should.equal(false);
  });

  it('GET /api/items returns all items', async () => {
    await Item.create({ name: 'Item A' });
    await Item.create({ name: 'Item B' });

    const res = await request(app)
      .get('/api/items')
      .expect(200);

    should(res.body).be.Array();
    res.body.length.should.equal(2);
  });

  it('GET /api/items/:id returns 404 for missing item (error path)', async () => {
    const missingId = new mongoose.Types.ObjectId();

    const res = await request(app)
      .get(`/api/items/${missingId}`)
      .expect(404);

    res.body.message.should.equal('Item not found');
  });

  it('PUT /api/items/:id updates an existing item', async () => {
    const item = await Item.create({ name: 'Old Name', completed: false });

    const res = await request(app)
      .put(`/api/items/${item._id}`)
      .send({ name: 'New Name', completed: true })
      .expect(200);

    res.body.name.should.equal('New Name');
    res.body.completed.should.equal(true);
  });

  it('DELETE /api/items/:id deletes an existing item', async () => {
    const item = await Item.create({ name: 'Delete me' });

    const res = await request(app)
      .delete(`/api/items/${item._id}`)
      .expect(200);

    res.body.message.should.equal('Item deleted successfully');

    const deleted = await Item.findById(item._id);
    should(deleted).equal(null);
  });
});
