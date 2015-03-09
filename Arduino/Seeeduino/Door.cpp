#include "Door.h"

Door::Door(String name, int pin) : Sensor(name, pin)
{
	//_highMsg = _name + " opened!";
	//_lowMsg = _name + " closed!";
}

void Door::check()
{
	if (digitalRead(_pin) && !_state)
	{
		sendMsg(_id, _highMsg);
		_state = 1;
		opened();
	}
	if (!digitalRead(_pin) && _state)
	{
		sendMsg(_id, _lowMsg);
		_state = 0;
	}
	leftOpened();
}

void Door::opened(){}

void Door::leftOpened(){}