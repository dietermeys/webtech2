var express = require('express'),
	app = express(),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server);

server.listen(3000);

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


io.sockets.on('connection', function(socket){
	socket.on('send message', function(data){
		io.sockets.emit('new message', data);//iedereen kan het zien(ook ik)
		//socket.broadcast.emit('new message', data);//iedereen kan het zien(behalve ik)
	});
});