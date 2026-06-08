const should = require('should');
const sinon = require('sinon');

const Item = require('../src/models/item.model');
const { createItem } = require('../src/controllers/items.controller');
const { createResponseValidator } = require('./utils');

describe('Items controller response validator', () => {
  let sandbox;

  beforeEach(() => {
    sandbox = sinon.createSandbox();
  });

  afterEach(() => {
    sandbox.restore();
  });

  it('intercepts res.json and validates status + payload', async () => {
    const fakeItem = { _id: '123', name: 'Intercepted', completed: false };
    sandbox.stub(Item, 'create').resolves(fakeItem);

    const req = {
      body: { name: 'Intercepted', completed: false },
    };

    const validator = createResponseValidator(201, (payload) => {
      payload.should.have.property('name', 'Intercepted');
      payload.should.have.property('completed', false);
    });

    const next = sandbox.stub();

    await createItem(req, validator.res, next);

    validator.state.sentWith.should.equal('json');
    validator.validate();
    next.called.should.equal(false);
  });
});
