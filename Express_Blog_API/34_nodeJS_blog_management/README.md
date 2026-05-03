# Blog Management REST API

An Express.js REST API where users can create, read, update, and delete blog posts. Blog data is stored in MongoDB.

## Setup

Install dependencies:

```bash
npm install
```

Start the server:

```bash
npm start
```

For development with automatic restart:

```bash
npm run dev
```

The API runs at:

```text
http://localhost:3000
```

Make sure your local MongoDB server is running before starting the API.

## Environment

The `.env` file contains:

```env
PORT=3000
MONGODB_URI=mongodb://127.0.0.1:27017/blog_management_api
```

The API uses `MONGODB_URI` to connect to MongoDB. The included value is a dummy local MongoDB connection string.

## API Endpoints

| Method | Endpoint | Description |
| --- | --- | --- |
| GET | `/` | API welcome and endpoint list |
| GET | `/api/posts` | View all blog posts |
| GET | `/api/posts/:id` | View one blog post |
| POST | `/api/posts` | Create a blog post |
| PUT | `/api/posts/:id` | Edit a blog post |
| DELETE | `/api/posts/:id` | Delete a blog post |

MongoDB creates string IDs such as `66324f74a8c8c6522c5f5931`. After creating a blog post, copy the returned `id` and use it in the view, edit, and delete requests.

## Postman Testing Commands

Use `http://localhost:3000` as the base URL in Postman.

### 1. Check API

Method: `GET`

URL:

```text
http://localhost:3000/
```

### 2. Create Blog Post

Method: `POST`

URL:

```text
http://localhost:3000/api/posts
```

Headers:

```text
Content-Type: application/json
```

Body: `raw` JSON

```json
{
  "title": "My First Blog Post",
  "content": "This is the content of my first blog post.",
  "author": "John Doe"
}
```

### 3. View All Blog Posts

Method: `GET`

URL:

```text
http://localhost:3000/api/posts
```

### 4. View Single Blog Post

Method: `GET`

URL:

```text
http://localhost:3000/api/posts/1
```

Replace `1` with the MongoDB `id` returned from the create request.

### 5. Edit Blog Post

Method: `PUT`

URL:

```text
http://localhost:3000/api/posts/1
```

Replace `1` with the MongoDB `id` returned from the create request.

Headers:

```text
Content-Type: application/json
```

Body: `raw` JSON

```json
{
  "title": "Updated Blog Post",
  "content": "This blog post has been updated.",
  "author": "Jane Doe"
}
```

### 6. Delete Blog Post

Method: `DELETE`

URL:

```text
http://localhost:3000/api/posts/1
```

Replace `1` with the MongoDB `id` returned from the create request.

## Sample Success Response

```json
{
  "success": true,
  "message": "Blog post created successfully",
  "data": {
    "id": "66324f74a8c8c6522c5f5931",
    "title": "My First Blog Post",
    "content": "This is the content of my first blog post.",
    "author": "John Doe",
    "createdAt": "2026-04-30T12:30:00.000Z",
    "updatedAt": "2026-04-30T12:30:00.000Z"
  }
}
```
