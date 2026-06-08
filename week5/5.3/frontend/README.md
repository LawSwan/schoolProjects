# Frontend Test Setup (Mocha + Enzyme + Chai + Sinon)

## Install

```bash
cd frontend
npm install
```

## Run Tests

```bash
npm test
```

## Rules implemented

- All HTTP service calls are mocked via a Sinon sandbox
- Sandbox is restored in `afterEach()`
- Component tests use Enzyme `mount()` and Chai `expect`
- Routed components are wrapped in `BrowserRouter`
- Tests include happy path and error path coverage

## Structure

- src/components/: React components under test
- src/services/: HTTP/API service layer to mock
- test/components/: frontend test files
- test/setup.js: Enzyme + jsdom setup for Mocha
