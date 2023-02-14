<?php

require_once "config.php";
require_once "inc/header.php";

?>

 <div>
    <h2> Temperature </h2>
    <div id="container_temperature">Temperature</div>
</div>
<div>
    <h2> Humidity </h2>
    <div id="container_humidity">Humidity</div>
</div>

<div>


    <h2> Display </h2>
    <div class="input-group mb-3">
        <textarea id='message' type="text" class="form-control" placeholder="Message on display" aria-label="Message on display" aria-describedby="button-addon2"></textarea>
        <button class="btn btn-outline-secondary" type="button" id="send_button" onclick="sendMessage()">Send Message on display</button>
    </div>

    <h2> GPIO </h2>
    <div id="cblist"></div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

<script>

    const divTemperature = document.getElementById('container_temperature');
    const divHumidity = document.getElementById('container_humidity');

    // Create a client instance
    var client = new Paho.MQTT.Client('<?php echo $MOSQUITTO_BROKER_URL ?>', <?php echo $MOSQUITTO_BROKER_WEBSOCKET_PORT ?>, "clientId");
    // connect the client
    client.connect({
        userName: '<?php echo $MOSQUITTO_BROKER_USER ?>',
        password: '<?php echo $MOSQUITTO_BROKER_PASSWORD ?>',
        onSuccess: function() {
            console.log("onConnect");
            client.subscribe("room/temperature");
            client.subscribe("room/humidity");
        }
    });
    // set callback handlers
    client.onConnectionLost = function (responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("onConnectionLost:" + responseObject.errorMessage);
        }
    };
    client.onMessageArrived = function (message) {

        if (message.destinationName === 'room/temperature') {
            divTemperature.textContent = message.payloadString + ' F';
        } else if (message.destinationName === 'room/humidity') {
            divHumidity.textContent = message.payloadString + ' %';
        }

    };

    $(document).ready(function(){
        // On-click button function
        $("send_button").click(function(){
            // Printing the input value in that specific div

            console.log("Send message to mgtt brocker")
            message = new Paho.MQTT.Message($('#message').val());
            message.destinationName = "room/display";
            client.send(message);

        });
    });

    function sendMessage() {
        console.log("Send message to mgtt brocker");
        message = new Paho.MQTT.Message($('#message').val());
        message.destinationName = "room/display";
        client.send(message);
    }

    $(document).ready(function() {

        addCheckbox({
            name: 'gpio25',
            pin_num: '25'
        });
        addCheckbox({
            name: 'gpio26',
            pin_num: '26'
        });
        addCheckbox({
            name: 'gpio27',
            pin_num: '27'
        });

    });

    function addCheckbox(gpio) {
        var container = $('#cblist');
        var inputs = container.find('input');
        var id = inputs.length + 1;

        var checkboxGroup = $('<div />', {class: 'form-check form-switch'}).appendTo(container);
        var input = $('<input />', {class: 'form-check-input', type: 'checkbox', id: 'cb' + id, value: gpio.name});
        input.appendTo(checkboxGroup);
        $('<label />', {class: 'form-check-label', 'for': 'cb' + id, text: gpio.name}).appendTo(checkboxGroup);

        input.change(function () {
            var message_mun_gpo = new Paho.MQTT.Message(gpio.pin_num);
            message_mun_gpo.destinationName = "room/oNoFFgpio/num";
            client.send(message_mun_gpo);

            var message = new Paho.MQTT.Message((this.checked ? 'on' : 'off'));
            message.destinationName = "room/oNoFFgpio/message";
            client.send(message);

        });
    }

</script>

<?php

require_once "inc/footer.php";

?>