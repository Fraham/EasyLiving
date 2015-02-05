#pragma once
#include <Arduino.h>
#include "Conn.h"

class Sensor
{
	public:
		Sensor(String name, int pin);
		int getPin();
		String getName();
		bool getState();
		virtual void check() = 0;
		
	protected:
		int _pin;
		String _name;
		bool _state;
		String _highMsg;
		String _lowMsg;
};

