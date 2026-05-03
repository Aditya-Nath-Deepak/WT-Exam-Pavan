# Task Manager REST API

A simple Express.js REST API for managing daily tasks. It supports adding tasks, retrieving all tasks, updating task status, and deleting completed tasks. All responses are returned in JSON format.

## Requirements

- Node.js installed on your system
- npm installed on your system

## Installation

Install project dependencies:

```bash
npm install
```

## Run the API

Start the server:

```bash
npm start
```

For development with automatic restart on file changes:

```bash
npm run dev
```

The API runs at:

```text
http://localhost:3000
```

To use a different port:

```bash
PORT=5000 npm start
```

## Dummy JSON Data

The project includes a sample data file:

```text
tasks.json
```

The API reads tasks from this file and saves changes back to the same file. You can edit `tasks.json` directly to add or change test data before starting the server.

Example `tasks.json` data:

```json
[
  {
    "id": 1,
    "title": "Plan daily schedule",
    "description": "Write down the top three tasks for the day.",
    "status": "pending",
    "createdAt": "2026-04-30T08:00:00.000Z",
    "updatedAt": "2026-04-30T08:00:00.000Z"
  }
]
```

Keep the file as a valid JSON array. Each task should have a unique numeric `id`.

## Task Object

Each task has this structure:

```json
{
  "id": 1,
  "title": "Buy groceries",
  "description": "Milk, bread, and vegetables",
  "status": "pending",
  "createdAt": "2026-04-30T10:00:00.000Z",
  "updatedAt": "2026-04-30T10:00:00.000Z"
}
```

Valid task statuses:

- `pending`
- `completed`

## API Endpoints

### Health / API Info

```http
GET /
```

Example:

```bash
curl http://localhost:3000/
```

### Add a Task

```http
POST /tasks
```

Request body:

```json
{
  "title": "Finish assignment",
  "description": "Complete the Express.js task manager API",
  "status": "pending"
}
```

Example:

```bash
curl -X POST http://localhost:3000/tasks \
  -H "Content-Type: application/json" \
  -d '{"title":"Finish assignment","description":"Complete the Express.js task manager API","status":"pending"}'
```

Notes:

- `title` is required.
- `description` is optional.
- `status` is optional and defaults to `pending`.

### Retrieve All Tasks

```http
GET /tasks
```

Example:

```bash
curl http://localhost:3000/tasks
```

### Edit a Task

```http
PUT /tasks/:id
```

Request body:

```json
{
  "title": "Finish updated assignment",
  "description": "Update the API and README",
  "status": "pending"
}
```

Example:

```bash
curl -X PUT http://localhost:3000/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Finish updated assignment","description":"Update the API and README","status":"pending"}'
```

You can send one field or multiple fields. Supported fields are `title`, `description`, and `status`.

### Update Task Status

```http
PATCH /tasks/:id/status
```

Request body:

```json
{
  "status": "completed"
}
```

Example:

```bash
curl -X PATCH http://localhost:3000/tasks/1/status \
  -H "Content-Type: application/json" \
  -d '{"status":"completed"}'
```

### Delete a Completed Task

```http
DELETE /tasks/:id
```

Example:

```bash
curl -X DELETE http://localhost:3000/tasks/1
```

Only tasks with status `completed` can be deleted.

## Error Responses

The API returns JSON error messages for invalid requests:

```json
{
  "error": "Task not found."
}
```

Common status codes:

- `200` - Request successful
- `201` - Task created
- `400` - Invalid request data
- `404` - Route or task not found

## Notes

Tasks are stored in `tasks.json`. Restarting the server keeps the saved tasks.
