# Backend Test Setup (Mocha + Should.js)

## Install

```bash
cd backend
npm install
```

## Run Tests

```bash
npm test
```

This setup uses an in-memory MongoDB instance during tests to guarantee isolation from production data.

## Structure

- src/: application code
- test/: API and controller tests
- test/utils.js: response validator for `res.json()` and `res.send()` interception
