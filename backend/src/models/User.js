import Sequelize, { Model } from 'sequelize'

class User extends Model {
    static init(sequelize){
        super.init(
            {
                email: {
                    type: Sequelize.STRING(255),
                    unique: true,
                    allowNull: false,
                  },
                  password: {
                    type: Sequelize.STRING(255),
                    allowNull: false,
                  },
                  company_name: {
                    type: Sequelize.STRING(255),
                    allowNull: false,
                  },
            }, 
            {sequelize})
    }
}

export default User