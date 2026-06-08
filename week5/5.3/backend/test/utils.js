const should = require('should');

function createResponseValidator(expectedStatus, expectedBodyMatcher) {
  const state = {
    statusCode: 200,
    payload: undefined,
    sentWith: null,
  };

  const res = {
    status(code) {
      state.statusCode = code;
      return this;
    },
    json(body) {
      state.payload = body;
      state.sentWith = 'json';
      return this;
    },
    send(body) {
      state.payload = body;
      state.sentWith = 'send';
      return this;
    },
  };

  function validate() {
    should(state.statusCode).equal(expectedStatus);
    should.exist(state.sentWith);

    if (typeof expectedBodyMatcher === 'function') {
      expectedBodyMatcher(state.payload);
    } else if (expectedBodyMatcher !== undefined) {
      state.payload.should.match(expectedBodyMatcher);
    }
  }

  return {
    res,
    state,
    validate,
  };
}

module.exports = {
  createResponseValidator,
};
