// Import dependencies
const SerialPort = require("serialport");
const Readline = require("@serialport/parser-readline");
const open = require('open');
fs = require('fs');

// Defining the serial port
const port = new SerialPort("COM5", {
    baudRate: 9600,
    autoOpen: false,

});

          
const parser = new Readline();
port.pipe(parser);
port.open(function (err) {
    if (err) {
      return console.log('Error opening port: ', err.message)
    }
  
    // Because there's no callback to write, write errors will be emitted on the port:
    port.write('70000')
    port.close()
    
  })
  
  // The open event is always emitted

