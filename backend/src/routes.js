import express from 'express';
import { createUser, updateUser, getAllUsers, getOneUser, deleteUser} from '../src/controllers/UserController.js'

const router = express.Router();

//Rotas de usuarios
router.post('/cadastro', createUser);
router.get('/todos', getAllUsers);
router.get('/todos:id', getOneUser);
router.put('/atualizar', updateUser);
router.delete('/deleta', deleteUser);

export default router