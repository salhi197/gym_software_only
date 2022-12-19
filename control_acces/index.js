// Import dependencies
const SerialPort = require("serialport");
const Readline = require("@serialport/parser-readline");
const open = require('open');
fs = require('fs');

// Defining the serial port
const port = new SerialPort("COM3", {
    baudRate: 9600,
    autoOpen: true

});

const fetch = require("node-fetch")
let matricule=0

fs.writeFile('logs.txt', '0', function (err) {
  if (err) return console.log(err);
  console.log('initail');
});
          

const parser = new Readline();
port.pipe(parser);
parser.on("data", function(line,matricule){
    line = line.replace(/\s/g, '');
    console.log(line)
    var array = fs.readFileSync('../public/records.txt').toString().split("\n");
    const dejaEntre = array.includes(line);



    fs.readFile('logs.txt', 'utf8' , (err, data) => {
    if (err) {
      console.error(err)
      return
    }

   matricule=data

  //  console.log(+line)
   if(line == data){
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
      console.log('passe à la vérification')
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

            fs.appendFileSync('../public/records.txt', line+"\n");

             console.log("le matricule "+line+" est autorisé")
             if(dejaEntre == true){
                console.log("déja entré")
                fs.writeFile('../public/logs.txt', line, function (err) {
                  if (err) return console.log(err);
                  // console.log('written222');
                });
                fs.writeFile('../public/logs2.txt', line, function (err) {
                  if (err) return console.log(err);
                  // console.log('written2');
                });
                

                return 0;

             }
                fs.writeFile('../public/logs.txt', line, function (err) {
                  if (err) return console.log(err);
                  // console.log('written222');
                });
                fs.writeFile('../public/logs2.txt', line, function (err) {
                  if (err) return console.log(err);
                  // console.log('written2');
                });
             var str = line.substring(0, line.length-2);
            //  console.log(str)
             //open('http://http://localhost:8000/membre/profile/'+str);
              fetch('http://localhost:8000/api/insert/presence', {
               method: 'post',
               headers: {'Accept': 'application/json, text/plain, */*','Content-Type': 'application/json'},
               body: JSON.stringify({matricule:line})
             }).then(res =>res.json())
             .then(res => {
              // console.log(res)
              port.write("70000")
              
        
              // fs.writeFile('logs.txt', line, function (err) {
                //  if (err) return console.log(err);
                //  console.log('written');
                // });
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

              // fs.writeFile('logs.txt', line, function (err) {
              //   if (err) return console.log(err);
              //   console.log('written');
              // });                                      
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

             // fs.writeFile('logs.txt', line, function (err) {
             //    if (err) return console.log(err);
             //    console.log('written');
             //  });
          }
 
         })
         .catch(err=>function (err) {
           console.log("err.message")
         });
   }
  })  

});
