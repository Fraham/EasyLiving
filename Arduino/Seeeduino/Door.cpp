#include "Door.h"


Door::Door(String name, char pin) : Sensor(name, pin)
{
	_highMsg = " opened!";
	_lowMsg = " closed!";
}

void Door::check()
{
	if (digitalRead(_pin) && !_state)
	{
		Serial.print(_name);
		Serial.println(_highMsg);
		_state = 1;
		opened();
	}
	if (!digitalRead(_pin) && _state)
	{
		Serial.print(_name);
		Serial.println(_lowMsg);
		_state = 0;
	}
	leftOpened();
}

void Door::opened(){}

void Door::leftOpened(){}