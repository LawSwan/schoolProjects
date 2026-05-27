# Mongoose Integration - Guided Practice

MEAN stack application demonstrating Mongoose and MongoDB integration.

## Setup

```bash
npm install
node server
```

Server runs at http://localhost:3000/

## Test User Creation

```bash
curl -X POST -H "Content-Type: application/json" \
  -d '{"firstName":"Amber","lastName":"Lawson","email":"amber@example.com","username":"amberlawson","password":"password"}' \
  localhost:3000/users
```
