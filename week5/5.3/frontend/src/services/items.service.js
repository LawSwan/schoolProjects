async function fetchItems() {
  throw new Error('Not implemented');
}

async function createItem(payload) {
  throw new Error(`Not implemented: ${JSON.stringify(payload)}`);
}

module.exports = {
  fetchItems,
  createItem,
};
