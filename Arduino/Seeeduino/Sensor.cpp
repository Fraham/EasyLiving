#include "Sensor.h"
#include <Arduino.h>

Sensor::Sensor(String name, char pin)
{
	_name = name;
	_pin = pin;
	_state = 1;
	Serial.begin(9600);
	pinMode(_pin, OUTPUT);
	_highMsg = "";
	_lowMsg = "";
}

char Sensor::getPin()
{
	return _pin;
}

String Sensor::getName()
{
	return _name;
}

bool Sensor::getState()
{
	return _state;
}

void Sensor::check(){};