const express = require('express');
const cors = require('cors')
const {Pool}= require('pg');

const pool = new Pool({
  host: 'localhost',
  user: 'postgres',      
  password: 'M361r2b2?',
  database: 'Vin',
  port : "5432",
})

const app = express();
app.use(cors({origin:'*'}));
const PORT = 8000;

app.use(express.json());

app.get('/donnees', async (req, res) => {
  try {
    const rows = await pool.query('SELECT * FROM cepages_vins WHERE quantite <= 0');
    res.json(rows);
    console.log('Données récupérées avec succès');
  } catch (err) {
    console.error('Erreur:', err);
    res.status(500).send('Erreur lors de la récupération des données');
  } finally {
    console.log("Good")
  }
});
app.get('/StockActuel', async (req, res) => {
  try {
    const rows = await pool.query('SELECT * FROM cepages_vins WHERE quantite > 0');
    res.json(rows);
    console.log('Données récupérées avec succès');
  } catch (err) {
    console.error('Erreur:', err);
    res.status(500).send('Erreur lors de la récupération des données');
  } finally {
    console.log("Good")
  }
});

app.listen(PORT, () => {
  console.log(`Serveur démarré sur http://localhost:${PORT}`);
});