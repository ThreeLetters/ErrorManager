
var url = "";
var dt = {
    
}


process.on('uncaughtException', (err) => {
    var querystring = require('querystring');
    var http = require('http');
dt.message = err.message;
    dt.stack = err.stack;
    var data = querystring.stringify(dt);
    var options = {
        host: url,
        port: 80,
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Content-Length': Buffer.byteLength(data)
        }
    }

    function thr() {
        console.log(err.message);
        console.log(err.stack);
        process.exit(1)
    }
    var req = http.request(options, function (res) {
        res.setEncoding('utf8');
var body = "";
res.on('data',function(d) {
    body += d;
})
res.on('end',function() {
    if (body) console.log(body);
    else
       thr();
})
     

    })
    req.on('error', function (e) {

        thr();
    })
    req.write(data);
    req.end();
});