# Library Book Management System

A Node.js application for managing book records in a library.

## Features

- Add new books to the library
- View all books in the library
- RESTful API for book management

## Prerequisites

- Node.js (v14 or higher)
- MongoDB

## Installation

1. Navigate to the backend directory:
   ```
   cd LibraryNodeJs/backend
   ```

2. Install dependencies:
   ```
   npm install
   ```

3. Start MongoDB service (if not already running).

4. Start the server:
   ```
   npm start
   ```

The server will run on http://localhost:5000

## API Endpoints

- GET /api/books - Retrieve all books
- POST /api/books - Add a new book

### Book Schema

```json
{
  "book_id": "string",
  "title": "string",
  "author": "string",
  "year": "number"
}
```

## Frontend

Open `LibraryNodeJs/frontend/index.html` in your browser to interact with the application.

The frontend allows you to:
- Add new books using the form
- View all books by clicking "Load Books"

## Project Structure

```
LibraryNodeJs/
├── backend/
│   ├── models/
│   │   └── Book.js
│   ├── routes/
│   │   └── books.js
│   ├── package.json
│   └── server.js
└── frontend/
    ├── index.html
    ├── script.js
    └── style.css
```