const Item = require('../models/item.model');

async function createItem(req, res, next) {
  try {
    const item = await Item.create({
      name: req.body.name,
      completed: req.body.completed,
    });

    return res.status(201).json(item);
  } catch (err) {
    return next(err);
  }
}

async function getItems(req, res, next) {
  try {
    const items = await Item.find().sort({ createdAt: -1 });
    return res.status(200).json(items);
  } catch (err) {
    return next(err);
  }
}

async function getItemById(req, res, next) {
  try {
    const item = await Item.findById(req.params.id);
    if (!item) {
      return res.status(404).json({ message: 'Item not found' });
    }
    return res.status(200).json(item);
  } catch (err) {
    return next(err);
  }
}

async function updateItem(req, res, next) {
  try {
    const item = await Item.findByIdAndUpdate(
      req.params.id,
      {
        name: req.body.name,
        completed: req.body.completed,
      },
      { new: true, runValidators: true }
    );

    if (!item) {
      return res.status(404).json({ message: 'Item not found' });
    }

    return res.status(200).json(item);
  } catch (err) {
    return next(err);
  }
}

async function deleteItem(req, res, next) {
  try {
    const item = await Item.findByIdAndDelete(req.params.id);

    if (!item) {
      return res.status(404).json({ message: 'Item not found' });
    }

    return res.status(200).json({ message: 'Item deleted successfully' });
  } catch (err) {
    return next(err);
  }
}

module.exports = {
  createItem,
  getItems,
  getItemById,
  updateItem,
  deleteItem,
};
