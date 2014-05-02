var port = 2014;
var app = require('express')();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
//var mysql = require('mysql');
console.log('Listening on port ' + port);
server.listen(port);

app.get('/', function (req, res) {
  res.sendfile(__dirname + '/ask.html');
});
app.get('/ask.html', function (req, res) {
  res.sendfile(__dirname + '/ask.html');
});
app.get('/wall.html', function (req, res) {
  res.sendfile(__dirname + '/wall.html');
});
app.get('/moderate.html', function (req, res) {
  res.sendfile(__dirname + '/moderate.html');
});
/*
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : ''
});

connection.connect();

connection.query('SELECT 1 + 1 AS solution', function(err, rows, fields) {
  if (err) throw err;

  console.log('The solution is: ', rows[0].solution);
});

connection.end();
*/
module.exports = app;
