var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  var myname = "Amber Lawson";
  var favoritePlaces = [
    "Roswell, New Mexico",
    "Sanford, Florida",
    "New Orleans, Louisiana",
    "Savannah, Georgia",
    "Nashville, Tennessee"
  ];
  res.render('index', { title: 'First Node App', myname: myname, favoritePlaces: favoritePlaces });
});

module.exports = router;
