var express = require('express'),
app = express(),
port = process.env.PORT || 3000,

mysql = require('mysql'),
Task = require('./api/models/bank'), //created model loading here
bodyParser = require('body-parser');

app.listen(port);
console.log('API server started on: ' + port);

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

var routes = require('./api/routes/bank'); //importing route
routes(app); //register the route