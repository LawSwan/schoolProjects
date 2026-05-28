# Practice Assignment: MEAN Stack MVC Application

A MEAN stack application showcasing the MongoDB, Express, Angular, and Node.js technology stack with proper MVC separation of concerns.

## Running the Application

```bash
npm install
npm start
```

The server will start on **http://localhost:3000**

## Preview

![PA MEAN MVC Preview](./preview.png)

## Project Structure

```
├── app/
│   ├── controllers/
│   │   └── index.server.controller.js
│   ├── models/
│   ├── routes/
│   │   └── index.server.routes.js
│   └── views/
│       └── index.ejs
├── config/
│   ├── env/
│   │   └── development.js
│   ├── config.js
│   └── express.js
├── public/
│   └── img/
├── server.js
└── package.json
```

## Stack Components

- **MongoDB** - A NoSQL document-oriented database that stores data in flexible, JSON-like BSON format, making it ideal for scalable web applications.
- **Express** - A minimal and flexible Node.js web application framework that provides a robust set of features for building web and API servers.
- **Angular** - A TypeScript-based front-end framework developed by Google for building dynamic, single-page web applications with a component-based architecture.
- **Node.js** - A cross-platform JavaScript runtime built on Chrome's V8 engine that enables server-side execution of JavaScript for fast, scalable network applications.

## Key Files

- `server.js` - Application entry point
- `config/express.js` - Express middleware configuration
- `app/routes/index.server.routes.js` - Route definitions
- `app/controllers/index.server.controller.js` - Business logic
- `app/views/index.ejs` - View template
