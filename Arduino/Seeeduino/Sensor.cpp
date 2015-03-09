#include "Sensor.h"

Sensor::Sensor(String id, int pin)
{
	//Serial.begin(9600);
	pinMode(_pin, INPUT);
	_id = id;
	_pin = pin;
	_state = true;
	_highMsg = "1";
	_lowMsg = "0";
}

int Sensor::getPin()
{
	return _pin;
}

String Sensor::getId()
{
	return _id;
}

bool Sensor::getState()
{
	return _state;
}

