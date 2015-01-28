#include "Fridge.h"


Fridge::Fridge(String name, char pin, char buzzPin) : Door(name, pin)
{
	Buzzer _buzzer = {7, false};
	_freq = 5;
	_waitTime = false;
}

void Fridge::opened()
{
	_openTime = millis();
	_switchTime = millis();
}

void Fridge::leftOpened()
{
	if (millis() - _openTime >= _timer)
	{
		bool switchTime = millis() - _switchTime >= _freq;
		if (!_waitTime &&  switchTime)
		{
			_buzzer.state = abs(_buzzer.state - 1);
			digitalWrite(_buzzer.pin, _buzzer.state);
			_waitTime = true;
			_switchTime = millis();
		}
		if (_waitTime && switchTime)
		{
			_waitTime = false;
			_switchTime = millis();
		}
	}
}

