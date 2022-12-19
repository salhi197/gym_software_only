// Import dependencies
const SerialPort = require("serialport");
const Readline = require("@serialport/parser-readline");
const open = require('open');
fs = require('fs');

// Defining the serial port
const port = new SerialPort("COM8", {
    baudRate: 9600,
});

const fetch = require("node-fetch")
let matricule=



let arr = [
  "4366676",
  "683172826",
  "683172826",
  "683898126"
  
  
]
fs.writeFile('logs.txt', '0', function (err) {
  if (err) return console.log(err);
  console.log('initail');
});
          

const parser = new Readline();
port.pipe(parser);
parser.on("data", function(line,matricule){

    fs.readFile('logs.txt', 'utf8' , (err, data) => {
    if (err) {
      console.error(err)
      return
    }

   matricule=data
   line = line.replace(/\s/g, '');
   console.log(+line)
   if(line == data && !arr.includes(data)){
     console.log('meme code scanné deux fois')
     return 0;
   }
 
   if(line == "A"){
     console.log('Telecommande');
     fetch('http://localhost:8000/api/ouverture', {
         method: 'post', 
         headers: {
           'Accept': 'application/json, text/plain, */*',
           'Content-Type': 'application/json'
         },
       }).then(res => res.json())
         .then(res => {
           console.log(res);
         })
         .catch(err=>function (err) {
           console.log("err.message")
         });
 
   }else{
       console.log('re')
     // open('http://127.0.0.1:8000/membre/edit/'+line);
     fetch('http://localhost:8000/api/membre/verifier', {
         method: 'post',
         headers: {
           'Accept': 'application/json, text/plain, */*',
           'Content-Type': 'application/json'
         },
         body: JSON.stringify({matricule:line})
       }).then(res => res.json())
         .then(res => {
         if(res.reponse){
           if(res.reponse == "1"){
             console.log("le matricule "+line+" est autorisé")
             var str = line.substring(0, line.length-2);
             console.log(str)
             //open('http://http://localhost:8000/membre/profile/'+str);
              fetch('http://localhost:8000/api/insert/presence', {
               method: 'post',
               headers: {'Accept': 'application/json, text/plain, */*','Content-Type': 'application/json'},
               body: JSON.stringify({matricule:line})
             }).then(res =>res.json())
             .then(res => {
              console.log(res)
               port.write("70000")
                fs.writeFile('logs.txt', line, function (err) {
                 if (err) return console.log(err);
                 console.log('written');
                });
                fs.writeFile('../public/logs.txt', line, function (err) {
                  if (err) return console.log(err);
                  console.log('written222');
                });
                fs.writeFile('../public/logs2.txt', line, function (err) {
                  if (err) return console.log(err);
                  console.log('written2');
                });
             })
 
           }else{
             console.log("non autorisé hh")
             if(line!="70000"){
              fs.writeFile('../public/logs.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written2');
              });
              fs.writeFile('../public/logs2.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written22222');
              });

              fs.writeFile('logs.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written');
              });                                      
             }
           }
         }else{
           // parser.write("Write your data here"); 
           console.log("non autorisé error")
              fs.writeFile('../public/logs.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written2');
              });
              fs.writeFile('../public/logs2.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written2222');
              });

             fs.writeFile('logs.txt', line, function (err) {
                if (err) return console.log(err);
                console.log('written');
              });
          }
 
         })
         .catch(err=>function (err) {
           console.log("err.message")
         });
   }
  })  
});
