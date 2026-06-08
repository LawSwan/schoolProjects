# Census MEAN Application

This repository contains a MEAN stack Census CRUD application for the final practical exam.

## Features

- Display census records with year, census taker name, household size, state, and city
- Add census records
- Update census records
- Delete census records

## Tech Stack

- Angular frontend in `client/`
- Express and Mongoose backend in `server/`
- MongoDB local database at `mongodb://127.0.0.1:27017/census_app`

## Run

1. Start MongoDB if it is not already running.
2. Install root dependencies: `npm install`
3. Start the API: `npm run server`
4. In a second terminal, start the client: `npm run client`

The API runs on `http://localhost:3000` and the Angular app runs on `http://localhost:4200`.

## Screenshots

Save your final screenshots in this repository root next to this README file before submission.
