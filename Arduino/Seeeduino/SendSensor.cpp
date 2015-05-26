#include "SendSensor.h"

SendSensor::SendSensor(String id, int pin)
{
	pinMode(_pin, INPUT);
	_id = id;
	_pin = pin;
	_state = true;
	

}


