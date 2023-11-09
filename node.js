const express = require('express');
const app = express();
const port = 3000;

app.use(express.json());

// In-memory array to store tasks
const tasks = [];

// Get all tasks
app.get('/tasks', (req, res) => {
  res.json(tasks);
});

// Create a new task
app.post('/tasks', (req, res) => {
  const newTask = req.body;
  tasks.push(newTask);
  res.status(201).json(newTask);
});

// Update a task by ID
app.put('/tasks/:id', (req, res) => {
  const taskId = req.params.id;
  const updatedTask = req.body;

  // Find the task by ID and update it
  const taskToUpdate = tasks.find(task => task.id === taskId);
  if (taskToUpdate) {
    Object.assign(taskToUpdate, updatedTask);
    res.json(taskToUpdate);
  } else {
    res.status(404).json({ error: 'Task not found' });
  }
});

// Delete a task by ID
app.delete('/tasks/:id', (req, res) => {
  const taskId = req.params.id;

  // Find the task by ID and remove it
  const taskIndex = tasks.findIndex(task => task.id === taskId);
  if (taskIndex !== -1) {
    tasks.splice(taskIndex, 1);
    res.sendStatus(204);
  } else {
    res.status(404).json({ error: 'Task not found' });
  }
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});