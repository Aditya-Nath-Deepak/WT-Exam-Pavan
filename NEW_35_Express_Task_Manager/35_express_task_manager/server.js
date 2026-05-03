const express = require("express");
const fs = require("fs");
const path = require("path");

const app = express();
const PORT = process.env.PORT || 3000;
const DATA_FILE = path.join(__dirname, "tasks.json");

app.use(express.json());

function readTasks() {
  try {
    const fileData = fs.readFileSync(DATA_FILE, "utf8");
    return JSON.parse(fileData);
  } catch (error) {
    if (error.code === "ENOENT") {
      writeTasks([]);
      return [];
    }

    throw error;
  }
}

function writeTasks(tasks) {
  fs.writeFileSync(DATA_FILE, JSON.stringify(tasks, null, 2));
}

function getNextTaskId(tasks) {
  if (tasks.length === 0) {
    return 1;
  }

  return Math.max(...tasks.map((task) => task.id)) + 1;
}

app.get("/", (req, res) => {
  res.json({
    message: "Task Manager REST API",
    endpoints: {
      addTask: "POST /tasks",
      getTasks: "GET /tasks",
      editTask: "PUT /tasks/:id",
      updateTaskStatus: "PATCH /tasks/:id/status",
      deleteTask: "DELETE /tasks/:id"
    }
  });
});

app.post("/tasks", (req, res) => {
  const { title, description = "", status = "pending" } = req.body;
  const tasks = readTasks();

  if (!title || typeof title !== "string" || !title.trim()) {
    return res.status(400).json({
      error: "Task title is required."
    });
  }

  if (!["pending", "completed"].includes(status)) {
    return res.status(400).json({
      error: "Status must be either 'pending' or 'completed'."
    });
  }

  const task = {
    id: getNextTaskId(tasks),
    title: title.trim(),
    description,
    status,
    createdAt: new Date().toISOString(),
    updatedAt: new Date().toISOString()
  };

  tasks.push(task);
  writeTasks(tasks);

  return res.status(201).json(task);
});

app.get("/tasks", (req, res) => {
  const tasks = readTasks();

  res.json(tasks);
});

app.put("/tasks/:id", (req, res) => {
  const taskId = Number(req.params.id);
  const { title, description, status } = req.body;
  const tasks = readTasks();

  if (!Number.isInteger(taskId) || taskId <= 0) {
    return res.status(400).json({
      error: "Task id must be a positive number."
    });
  }

  if (title !== undefined && (!title || typeof title !== "string" || !title.trim())) {
    return res.status(400).json({
      error: "Task title must be a non-empty string."
    });
  }

  if (status !== undefined && !["pending", "completed"].includes(status)) {
    return res.status(400).json({
      error: "Status must be either 'pending' or 'completed'."
    });
  }

  const task = tasks.find((item) => item.id === taskId);

  if (!task) {
    return res.status(404).json({
      error: "Task not found."
    });
  }

  if (title !== undefined) {
    task.title = title.trim();
  }

  if (description !== undefined) {
    task.description = description;
  }

  if (status !== undefined) {
    task.status = status;
  }

  task.updatedAt = new Date().toISOString();
  writeTasks(tasks);

  return res.json(task);
});

app.patch("/tasks/:id/status", (req, res) => {
  const taskId = Number(req.params.id);
  const { status } = req.body;
  const tasks = readTasks();

  if (!Number.isInteger(taskId) || taskId <= 0) {
    return res.status(400).json({
      error: "Task id must be a positive number."
    });
  }

  if (!["pending", "completed"].includes(status)) {
    return res.status(400).json({
      error: "Status must be either 'pending' or 'completed'."
    });
  }

  const task = tasks.find((item) => item.id === taskId);

  if (!task) {
    return res.status(404).json({
      error: "Task not found."
    });
  }

  task.status = status;
  task.updatedAt = new Date().toISOString();
  writeTasks(tasks);

  return res.json(task);
});

app.delete("/tasks/:id", (req, res) => {
  const taskId = Number(req.params.id);
  const tasks = readTasks();

  if (!Number.isInteger(taskId) || taskId <= 0) {
    return res.status(400).json({
      error: "Task id must be a positive number."
    });
  }

  const task = tasks.find((item) => item.id === taskId);

  if (!task) {
    return res.status(404).json({
      error: "Task not found."
    });
  }

  if (task.status !== "completed") {
    return res.status(400).json({
      error: "Only completed tasks can be deleted."
    });
  }

  const updatedTasks = tasks.filter((item) => item.id !== taskId);
  writeTasks(updatedTasks);

  return res.json({
    message: "Task deleted successfully.",
    task
  });
});

app.use((req, res) => {
  res.status(404).json({
    error: "Route not found."
  });
});

app.listen(PORT, () => {
  console.log(`Task Manager API is running on http://localhost:${PORT}`);
});
