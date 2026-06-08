const React = require('react');
const { Link } = require('react-router-dom');

function NavMenu() {
  return React.createElement(
    'nav',
    { className: 'main-nav' },
    React.createElement(Link, { to: '/' }, 'Home'),
    React.createElement('span', null, ' | '),
    React.createElement(Link, { to: '/items' }, 'Items')
  );
}

module.exports = NavMenu;
