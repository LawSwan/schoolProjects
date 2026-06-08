const { JSDOM } = require('jsdom');
const Enzyme = require('enzyme');
const Adapter = require('@wojtekmaj/enzyme-adapter-react-17');

const dom = new JSDOM('<!doctype html><html><body></body></html>', {
	url: 'http://localhost/',
});

const forgivingAtob = (value) => Buffer.from(String(value), 'base64').toString('binary');
const forgivingBtoa = (value) => Buffer.from(String(value), 'binary').toString('base64');

global.window = dom.window;
global.document = dom.window.document;
global.navigator = { userAgent: 'node.js' };
global.atob = forgivingAtob;
global.btoa = forgivingBtoa;
global.window.atob = forgivingAtob;
global.window.btoa = forgivingBtoa;

Object.getOwnPropertyNames(dom.window).forEach((property) => {
	if (typeof global[property] === 'undefined') {
		global[property] = dom.window[property];
	}
});

Enzyme.configure({ adapter: new Adapter() });
