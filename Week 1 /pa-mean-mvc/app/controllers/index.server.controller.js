exports.render =
  function (req, res) {
    if (req.session.lastVisit) {
      console.log(req.session.lastVisit);
    }
    req.session.lastVisit = new Date();

    var myName = "Amber Lawson";
    var pageTitle = "The MEAN Stack";
    var definitions = [
      {
        term: "MongoDB",
        definition: "A NoSQL document-oriented database that stores data in flexible, JSON-like BSON format, making it ideal for scalable web applications."
      },
      {
        term: "Express",
        definition: "A minimal and flexible Node.js web application framework that provides a robust set of features for building web and API servers."
      },
      {
        term: "Angular",
        definition: "A TypeScript-based front-end framework developed by Google for building dynamic, single-page web applications with a component-based architecture."
      },
      {
        term: "Node.js",
        definition: "A cross-platform JavaScript runtime built on Chrome's V8 engine that enables server-side execution of JavaScript for fast, scalable network applications."
      }
    ];

    res.render('index', { myName: myName, pageTitle: pageTitle, definitions: definitions });
  };
