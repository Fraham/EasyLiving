#pragma once
#include <Arduino.h>
#include "Conn.h"

class Sensor
{
	public:
		Sensor(String id, int pin);
		int getPin();
		String getId();
		bool getState();
		virtual void check() = 0;
		
	protected:
		int _pin;
		String _id;
		bool _state;
		String _highMsg;
		String _lowMsg;
};

