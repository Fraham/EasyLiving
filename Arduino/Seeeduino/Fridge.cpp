#include "Fridge.h"
#define alarmDelay 10000 //time before alarm (ms)
#define buzzDelay 100 //delay between state switch (ms)
#define buzzFreq 250 //tone frequency (Hz)


Fridge::Fridge(String name, int pin, int buzzPin) : Door(name, pin)
{
	pinMode(buzzPin, OUTPUT);
	_buzzPin = buzzPin;
	_buzzState = false;
}

void Fridge::opened()
{
	_openTime = millis();
	_switchTime = millis();
}

void Fridge::leftOpened()
{
	if (_state && millis() - _openTime >= alarmDelay)
	{
		bool switchTime = millis() - _switchTime >= buzzDelay;
		if (!_buzzState &&  switchTime)
		{
			tone(_buzzPin, buzzFreq);
			_buzzState = true;
			_switchTime = millis();
		}
		else if (_buzzState && switchTime)
		{
			noTone(_buzzPin);
			_buzzState = false;
			_switchTime = millis();
		}
	}
	else noTone(_buzzPin);
}

