import User from '../models/User.js'
import crypto from 'node:crypto'

export const createUser = async (req, res) => {
    try{ 
    const userToCreate = {
        id: crypto.randomUUID(),
        email: req.body.email,
        password: req.body.password,
        company_name: req.body.company_name
    }

    const user = await User.create(userToCreate);

    res.status(201).json({user});
    } catch(err){
        res.status(500).json(err);
    }
}

export const updateUser = (req, res) => {
    res.status(200).json({message: 'Ok'})
}

export const getAllUsers = (req, res) => {
    res.status(200).json({message: 'Ok'})
}

export const getOneUser = (req, res) => {
    res.status(200).json({message: 'Ok'})
}

export const deleteUser = (req, res) => {
    res.status(200).json({message: 'Ok'})
}
