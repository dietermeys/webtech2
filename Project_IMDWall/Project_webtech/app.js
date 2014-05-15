var express = require('express'),
	app = express(),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server),
	mongoose = require('mongoose'),
	nicknames = [];

server.listen(3000);

mongoose.connect('mongodb://localhost/wall', function(err){
	if(err){
		console.log(err);
		console.log('mislukt');
	}
	else{
		console.log('Connected');
	}
});

var wallSchema = mongoose.Schema({
	id: Number,
	nick: String,
	msg: String,
	like: {type: Number, default: "0"},
	created: {type: Date, default: Date.now}
});

var Question = mongoose.model('Question', wallSchema);

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

	var query = Question.find({});
	query.sort('-created').exec(function(err, docs){		//exec laat het werken
		if(err) throw err;
		socket.emit('load old msgs', docs);
	});


	socket.on('new user', function(data, callback){
		if (nicknames.indexOf(data) != -1){
			callback(false);
		} else{
			callback(true);
			socket.nickname = data;
			nicknames.push(socket.nickname);
			updateNicknames();
		}
	});


	function updateNicknames(){
		io.sockets.emit('usernames', nicknames);
	}

	socket.on('send message', function(data){
		var newMsg = new Question({msg: data, nick: socket.nickname});//document aanmaken
		newMsg.save(function(err){ //save
			if(err) throw  err;
		});
		io.sockets.emit('new message', {msg: data, nick: socket.nickname});//iedereen kan het zien(ook ik)
		//socket.broadcast.emit('new message', {msg: data, nick: socket.nickname});
	});

	socket.on('disconnect', function(data){
		if(!socket.nickname) return;
		nicknames.splice(nicknames.indexOf(socket.nickname), 1);
		updateNicknames();	
	});


});