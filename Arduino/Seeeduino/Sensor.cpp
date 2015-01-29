#include "Sensor.h"
#include <Arduino.h>

Sensor::Sensor(String name, int pin)
{
	Serial.begin(9600);
	//digitalWrite(_pin, LOW);
	pinMode(_pin, INPUT);
	_name = name;
	_pin = pin;
	_state = true;
	_highMsg = "";
	_lowMsg = "";
}

int Sensor::getPin()
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

//void Sensor::check(){ Serial.println(_pin); };