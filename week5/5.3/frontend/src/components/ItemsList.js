const React = require('react');
const itemsService = require('../services/items.service');

function ItemsList() {
  const [items, setItems] = React.useState([]);
  const [loading, setLoading] = React.useState(true);
  const [error, setError] = React.useState('');

  React.useEffect(() => {
    let active = true;

    itemsService
      .fetchItems()
      .then((data) => {
        if (!active) return;
        setItems(data);
      })
      .catch((err) => {
        if (!active) return;
        setError(err.message || 'Failed to load items');
      })
      .finally(() => {
        if (!active) return;
        setLoading(false);
      });

    return () => {
      active = false;
    };
  }, []);

  if (loading) {
    return React.createElement('p', { className: 'loading' }, 'Loading...');
  }

  if (error) {
    return React.createElement('p', { className: 'error' }, error);
  }

  const listChildren = items.map((item) =>
    React.createElement(
      'li',
      { key: item.id || item._id, className: 'item-row' },
      item.name
    )
  );

  return React.createElement(
    'section',
    null,
    React.createElement('h2', null, 'Items'),
    React.createElement('ul', { className: 'items-list' }, listChildren)
  );
}

module.exports = ItemsList;
