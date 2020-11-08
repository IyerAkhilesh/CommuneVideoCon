const http = require("../js/node_modules/http/index.js");
var mysql = require("../js/node_modules/mysql/index.js");
var app = express();

var connection = mysql.createConnection({
	host: "localhost",
	user: "akhilesh",
	password: "akhilesh",
	database: "commune"
});

connection.connect(function(err){
	if (err)
		return console.error("error: " + err.message);

	console.log('Connected to the MySQL server.');
});

// app.get("/", function(req,res){
// 	console.log(req);
// 	connection.query("SELECT * FROM commune.personal_data_lecture;", function(error, rows, fields){
// 		if(!!error){
// 			console.log("Error in query!");
// 		}
// 		else{
// 			console.log("Successfull query");
// 			console.log(rows);
// 		}
// 	});
// }).listen(8080);

http.createServer( (req, res) => {
	req.on("data", (data) =>{
		connection.query("update personal_data_lecture set `notes`='"+data+"' where `pdata_id`=1", function(error){
			console.log("Updating");
		});
	});

	req.on("end", ()=>{
		console.log("Updated");
	})
}).listen(8080);

/*require(["../js/node_modules/mysql/index.js"], function(mysql){
	console.log(mysql);
	var connection = mysql.createConnection({
		host: "localhost",
		user: "akhilesh",
		password: "akhilesh",
		database: "commune"
	});

	connection.connect(function(err){
		if (err)
			return console.error("error: " + err.message);

		console.log('Connected to the MySQL server.');
	});	
});
*/