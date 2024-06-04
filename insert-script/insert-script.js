const { Pool } = require('pg');

const pool = new Pool({
  user: 'postgres',
  host: 'database',
  database: 'chatdb',
  password: 'password',
  port: 5432,
});

const insertData = async () => {
  await pool.query('INSERT INTO users (username) VALUES ($1)', ['testuser']);
  console.log('Data inserted');
  process.exit();
};

insertData().catch(err => console.error('Error inserting data:', err));

