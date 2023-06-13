// Variables globales
var heartRateClient = null;
var heartRateConnected = false;
var heartRateTopic = 'frecuencia_cardiaca';

// Función para establecer la conexión MQTT para la frecuencia cardíaca
function connectHeartRate() {
  var hostname = '34.141.129.58';
  var port = '9001';
  var clientId = "js-heart-rate-" + makeid();
  var path = '/ws';
  var user = 'usuarioiot';
  var pass = '';

  heartRateClient = new Paho.Client(hostname, Number(port), path, clientId);

  logHeartRateMessage("INFO", "Connecting to Server: [Host: ", hostname, ", Port: ", port, ", Path: ", heartRateClient.path, ", ID: ", clientId, "]");

  // Set callback handlers
  heartRateClient.onConnectionLost = onHeartRateConnectionLost;
  heartRateClient.onMessageArrived = onHeartRateMessageArrived;
  heartRateClient.onConnected = onHeartRateConnected;

  var options = {
    timeout: 3,
    cleanSession: true,
    useSSL: false,
    onSuccess: onHeartRateConnect,
    onFailure: onHeartRateFail
  };

  if (user.length > 0) {
    options.userName = user;
  }

  if (pass.length > 0) {
    options.password = pass;
  }

  // Connect the client
  heartRateClient.connect(options);
}

// Callback cuando la conexión MQTT para la frecuencia cardíaca se establece con éxito
function onHeartRateConnect() {
  logHeartRateMessage("INFO", "Connected to Heart Rate Server.");
  heartRateConnected = true;
  subscribeHeartRate();
}

// Callback cuando la conexión MQTT para la frecuencia cardíaca falla
function onHeartRateFail(context) {
  logHeartRateMessage("ERROR", "Failed to connect to Heart Rate Server. [Error Message: ", context.errorMessage, "]");
  heartRateConnected = false;
}

// Callback cuando la conexión MQTT para la frecuencia cardíaca se pierde
function onHeartRateConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    logHeartRateMessage("INFO", "Connection to Heart Rate Server Lost. [Error Message: ", responseObject.errorMessage, "]");
  }
  heartRateConnected = false;
}

// Callback cuando la conexión MQTT para la frecuencia cardíaca se establece
function onHeartRateConnected(reconnect, uri) {
  logHeartRateMessage("INFO", "Client has connected to Heart Rate Server: [Reconnected: ", reconnect, ", URI: ", uri, "]");
  heartRateConnected = true;
}

// Callback cuando llega un mensaje MQTT para la frecuencia cardíaca
function onHeartRateMessageArrived(message) {
  logHeartRateMessage("INFO", "Heart Rate Message Received: [Topic: ", message.destinationName, ", Payload: ", message.payloadString, "]");
  var heartRateValue = message.payloadString;
  updateHeartRateValue(heartRateValue);
}

// Suscribirse al tema MQTT de la frecuencia cardíaca
function subscribeHeartRate() {
  logHeartRateMessage("INFO", "Subscribing to Heart Rate Topic: [Topic: ", heartRateTopic, "]");
  heartRateClient.subscribe(heartRateTopic, { qos: 0 });
}

// Actualizar el valor de la frecuencia cardíaca en el HTML
function updateHeartRateValue(value) {
  var heartRateElement = document.getElementById("heartRateValue");
  heartRateElement.innerHTML = value;
}

// Log de mensajes para la frecuencia cardíaca
function logHeartRateMessage(type, ...content) {
  var date = new Date();
  var timeString = date.toUTCString();
  var logMessage = timeString + " - " + type + " - " + content.join("");

  if (type === "INFO") {
    console.info(logMessage);
  } else if (type === "ERROR") {
    console.error(logMessage);
  } else {
    console.log(logMessage);
  }
}

// Generar una ID aleatoria
function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 5; i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }

  return text;
}
