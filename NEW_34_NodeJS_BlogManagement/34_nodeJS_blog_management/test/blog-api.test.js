const assert = require("node:assert/strict");
const test = require("node:test");
const dotenv = require("dotenv");
const mongoose = require("mongoose");
const app = require("../src/app");
const BlogPost = require("../src/models/BlogPost");

dotenv.config();

test("blog post CRUD flow with MongoDB", async (t) => {
  try {
    await mongoose.connect(process.env.MONGODB_URI, {
      serverSelectionTimeoutMS: 1000
    });
  } catch (error) {
    t.skip("Local MongoDB is not available");
    return;
  }

  await BlogPost.deleteMany({});

  const server = await new Promise((resolve) => {
    const listener = app.listen(0, "127.0.0.1", () => resolve(listener));
  });
  const baseUrl = `http://127.0.0.1:${server.address().port}`;
  let postId;

  try {
    const created = await requestJson(baseUrl, "/api/posts", {
      method: "POST",
      body: {
        title: "My First Blog Post",
        content: "This is the content of my first blog post.",
        author: "John Doe"
      }
    });

    assert.equal(created.status, 201);
    assert.equal(created.body.success, true);
    assert.ok(created.body.data.id);
    postId = created.body.data.id;

    const list = await requestJson(baseUrl, "/api/posts");
    assert.equal(list.status, 200);
    assert.equal(list.body.count, 1);

    const single = await requestJson(baseUrl, `/api/posts/${postId}`);
    assert.equal(single.status, 200);
    assert.equal(single.body.data.title, "My First Blog Post");

    const updated = await requestJson(baseUrl, `/api/posts/${postId}`, {
      method: "PUT",
      body: {
        title: "Updated Blog Post",
        content: "This blog post has been updated.",
        author: "Jane Doe"
      }
    });

    assert.equal(updated.status, 200);
    assert.equal(updated.body.data.title, "Updated Blog Post");

    const deleted = await requestJson(baseUrl, `/api/posts/${postId}`, {
      method: "DELETE"
    });

    assert.equal(deleted.status, 200);
    assert.equal(deleted.body.data.id, postId);
  } finally {
    await BlogPost.deleteMany({});
    await mongoose.disconnect();
    await new Promise((resolve, reject) => {
      server.close((error) => (error ? reject(error) : resolve()));
    });
  }
});

async function requestJson(baseUrl, path, options = {}) {
  const response = await fetch(`${baseUrl}${path}`, {
    method: options.method || "GET",
    headers: {
      "Content-Type": "application/json"
    },
    body: options.body ? JSON.stringify(options.body) : undefined
  });

  return {
    status: response.status,
    body: await response.json()
  };
}
