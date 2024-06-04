const express = require('express');
const app = express();
const { Pool } = require('pg');

const pool = new Pool({
  user: 'postgres',
  host: 'database',
  database: 'chatdb',
  password: 'password',
  port: 5432,
});

app.use(express.json());

app.get('/', (req, res) => {
  res.send('Hello World!');
});

// Endpoint pour obtenir les utilisateurs
app.get('/users', async (req, res) => {
  const result = await pool.query('SELECT * FROM users');
  res.json(result.rows);
});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});

