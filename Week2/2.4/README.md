# 2.4 Performance Assessment - Extended Mongoose Schema

MEAN stack application that extends the User schema from the 2.3 guided
practice with default values and schema modifiers, per the textbook section
"Extending your Mongoose schema".

## Setup

```bash
npm install
node server
```

Server runs at http://localhost:3000/

## Schema Extensions

`app/models/user.server.model.js` adds:

- **Default values** - `created` date defaults to `Date.now`.
- **Predefined modifiers** - `trim: true` on string fields and
  `lowercase: true` on `email`.
- **Custom setter modifier** - `firstName` is capitalized on save.
- **Custom getter modifier** - `website` is prefixed with `http://` when a
  protocol is missing; getters are applied to `toJSON` / `toObject`.

## Test User Creation with curl (GitBash)

```bash
curl -X POST -H "Content-Type: application/json" \
  -d '{"firstName":"amber","lastName":"Lawson","email":"AMBER@EXAMPLE.COM","username":"amberlawson","password":"password","website":"amberlawson.dev"}' \
  localhost:3000/users
```

Expected results in MongoDB:

- `firstName` -> `"Amber"` (custom setter capitalized it)
- `email` -> `"amber@example.com"` (lowercase modifier)
- `created` -> auto-populated timestamp
- `website` -> stored as `"amberlawson.dev"`, returned as
  `"http://amberlawson.dev"` via the getter

## Screenshots

- `server-running.png` - VS Code console after the user is added
- `curl-success.png` - GitBash console after the successful POST
