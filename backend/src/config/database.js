export default {
    dialect: 'postgres',
    host: 'localhost',
    username: 'postgres',
    password: 'admin@456',
    database: 'db_esg',
    define: {
        timestamp: true,
        unserscored: true,
        unserscoredAll: true,
    }
}