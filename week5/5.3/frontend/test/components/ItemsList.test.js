const React = require('react');
const { mount } = require('enzyme');
const { expect } = require('chai');
const sinon = require('sinon');

const ItemsList = require('../../src/components/ItemsList');
const itemsService = require('../../src/services/items.service');

describe('ItemsList component', () => {
  let sandbox;

  beforeEach(() => {
    sandbox = sinon.createSandbox();
  });

  afterEach(() => {
    sandbox.restore();
  });

  it('renders fetched items (happy path)', async () => {
    sandbox.stub(itemsService, 'fetchItems').resolves([
      { id: '1', name: 'Alpha' },
      { id: '2', name: 'Beta' },
    ]);

    const wrapper = mount(React.createElement(ItemsList));

    await new Promise(setImmediate);
    wrapper.update();

    expect(wrapper.find('li.item-row')).to.have.lengthOf(2);
    expect(wrapper.text()).to.contain('Alpha');
    expect(wrapper.text()).to.contain('Beta');

    wrapper.unmount();
  });

  it('renders error message when service fails (error path)', async () => {
    sandbox.stub(itemsService, 'fetchItems').rejects(new Error('Network failed'));

    const wrapper = mount(React.createElement(ItemsList));

    await new Promise(setImmediate);
    wrapper.update();

    expect(wrapper.find('p.error')).to.have.lengthOf(1);
    expect(wrapper.find('p.error').text()).to.equal('Network failed');

    wrapper.unmount();
  });
});
