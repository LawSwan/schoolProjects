const React = require('react');
const { mount } = require('enzyme');
const { expect } = require('chai');
const { BrowserRouter } = require('react-router-dom');

const NavMenu = require('../../src/components/NavMenu');

describe('NavMenu component', () => {
  it('renders links when wrapped in BrowserRouter', () => {
    const wrapper = mount(
      React.createElement(BrowserRouter, null, React.createElement(NavMenu))
    );

    expect(wrapper.find('a')).to.have.lengthOf(2);
    expect(wrapper.text()).to.contain('Home');
    expect(wrapper.text()).to.contain('Items');

    wrapper.unmount();
  });
});
