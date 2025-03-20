import express from 'express';
import User from './models/User.js'
import { Sequelize } from 'sequelize';
import config from './config/database.js';
import routes from './routes.js';

const app = express();
app.use(express.json());

const sequelize = new Sequelize(config);
User.init(sequelize);

app.use('/api', routes);

sequelize.authenticate().then(() => {
    console.log('Database conected');
    const port = 3000;
    app.listen(port, () => console.log(`Server is ON in port ${port}`));
}).catch(err => {
    console.log(err);
})