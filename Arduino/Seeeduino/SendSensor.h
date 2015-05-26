#pragma once
#include <Arduino.h>
#include "Conn.h"

class SendSensor
{
	public:
		SendSensor(String id, int pin);
		
	protected:
		int _pin;
		String _id;
		bool _state;
};