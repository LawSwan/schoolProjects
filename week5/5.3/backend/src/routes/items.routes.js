const express = require('express');
const controller = require('../controllers/items.controller');

const router = express.Router();

router.post('/', controller.createItem);
router.get('/', controller.getItems);
router.get('/:id', controller.getItemById);
router.put('/:id', controller.updateItem);
router.delete('/:id', controller.deleteItem);

module.exports = router;
