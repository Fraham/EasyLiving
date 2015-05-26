#include "Sensor.h"

Sensor::Sensor(String id, int pin)
{
	pinMode(_pin, INPUT);
	_id = id;
	_pin = pin;
	_state = true;
	_last = 0;
	

}

void Sensor::debounce(long last)
{
	if ((millis() - last) > _debounceDelay) 
	{
		interrupted();
		_last = millis();
	}
}

void Sensor::interrupted()
{
	int state = digitalRead(_pin);
	sendMsg(_id, state);
        Serial.println(_id + _state);
}

