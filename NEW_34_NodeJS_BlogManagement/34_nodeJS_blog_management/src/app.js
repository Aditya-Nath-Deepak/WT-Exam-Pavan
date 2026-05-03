const express = require("express");
const mongoose = require("mongoose");
const BlogPost = require("./models/BlogPost");

const app = express();

app.use(express.json());

app.get("/", (req, res) => {
  res.json({
    message: "Blog Management REST API",
    endpoints: {
      listPosts: "GET /api/posts",
      getPost: "GET /api/posts/:id",
      createPost: "POST /api/posts",
      updatePost: "PUT /api/posts/:id",
      deletePost: "DELETE /api/posts/:id"
    }
  });
});

app.get("/api/posts", async (req, res, next) => {
  try {
    const posts = await BlogPost.find().sort({ createdAt: -1 });

    res.json({
      success: true,
      count: posts.length,
      data: posts
    });
  } catch (error) {
    next(error);
  }
});

app.get("/api/posts/:id", async (req, res, next) => {
  try {
    if (!isValidObjectId(req.params.id)) {
      return res.status(400).json({
        success: false,
        message: "Invalid blog post id"
      });
    }

    const post = await BlogPost.findById(req.params.id);

    if (!post) {
      return res.status(404).json({
        success: false,
        message: "Blog post not found"
      });
    }

    res.json({
      success: true,
      data: post
    });
  } catch (error) {
    next(error);
  }
});

app.post("/api/posts", async (req, res, next) => {
  try {
    const validationError = validatePostInput(req.body);

    if (validationError) {
      return res.status(400).json({
        success: false,
        message: validationError
      });
    }

    const post = await BlogPost.create({
      title: req.body.title,
      content: req.body.content,
      author: req.body.author
    });

    res.status(201).json({
      success: true,
      message: "Blog post created successfully",
      data: post
    });
  } catch (error) {
    next(error);
  }
});

app.put("/api/posts/:id", async (req, res, next) => {
  try {
    if (!isValidObjectId(req.params.id)) {
      return res.status(400).json({
        success: false,
        message: "Invalid blog post id"
      });
    }

    const validationError = validatePostInput(req.body);

    if (validationError) {
      return res.status(400).json({
        success: false,
        message: validationError
      });
    }

    const post = await BlogPost.findByIdAndUpdate(
      req.params.id,
      {
        title: req.body.title,
        content: req.body.content,
        author: req.body.author
      },
      {
        new: true,
        runValidators: true
      }
    );

    if (!post) {
      return res.status(404).json({
        success: false,
        message: "Blog post not found"
      });
    }

    res.json({
      success: true,
      message: "Blog post updated successfully",
      data: post
    });
  } catch (error) {
    next(error);
  }
});

app.delete("/api/posts/:id", async (req, res, next) => {
  try {
    if (!isValidObjectId(req.params.id)) {
      return res.status(400).json({
        success: false,
        message: "Invalid blog post id"
      });
    }

    const deletedPost = await BlogPost.findByIdAndDelete(req.params.id);

    if (!deletedPost) {
      return res.status(404).json({
        success: false,
        message: "Blog post not found"
      });
    }

    res.json({
      success: true,
      message: "Blog post deleted successfully",
      data: deletedPost
    });
  } catch (error) {
    next(error);
  }
});

app.use((req, res) => {
  res.status(404).json({
    success: false,
    message: "Route not found"
  });
});

function validatePostInput(body) {
  if (!body.title || typeof body.title !== "string" || !body.title.trim()) {
    return "Title is required";
  }

  if (!body.content || typeof body.content !== "string" || !body.content.trim()) {
    return "Content is required";
  }

  if (!body.author || typeof body.author !== "string" || !body.author.trim()) {
    return "Author is required";
  }

  return null;
}

function isValidObjectId(id) {
  return mongoose.Types.ObjectId.isValid(id);
}

app.use((error, req, res, next) => {
  console.error(error);

  res.status(500).json({
    success: false,
    message: "Internal server error"
  });
});

module.exports = app;
