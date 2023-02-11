<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>bobbyhadz.com</title>
    <meta charset="UTF-8" />
</head>

<body>
<div>
    <h2> Temperature </h2>
    <div id="container_temperature">Temperature</div>
</div>
<div>
    <h2> Humidity </h2>
    <div id="container_humidity">Humidity</div>
</div>
</body>

<script>

    const divTemperature = document.getElementById('container_temperature');
    const divHumidity = document.getElementById('container_humidity');

    // Create a client instance
    var client = new Paho.MQTT.Client('192.168.4.38', Number(9001), "clientId");

    // set callback handlers
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // connect the client
    client.connect({
        userName: 'admin',
        password: '123456',
        onSuccess: onConnect
    });


    // called when the client connects
    function onConnect() {
// Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        client.subscribe("room/temperature");
        client.subscribe("room/humidity");
        // message = new Paho.MQTT.Message("Hello");
        // message.destinationName = "World";
        // client.send(message);
    }

    // called when the client loses its connection
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    }

    // called when a message arrives
    function onMessageArrived(message) {

        if (message.destinationName == 'room/temperature') {
            divTemperature.textContent = message.payloadString;
        } else if (message.destinationName == 'room/humidity') {
            divHumidity.textContent = message.payloadString;
        }

    }

</script>

</html>