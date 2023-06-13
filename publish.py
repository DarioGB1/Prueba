import paho.mqtt.publish as publish


credentials = {
    'username': 'usuarioiot',
    'password': 'dariojebe'
}

publish.single("boton_bool", "1", hostname="34.141.129.58", auth=credentials)
publish.single("valor_analog", "357", hostname="34.141.129.58", auth=credentials)