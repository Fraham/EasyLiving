#pragma once
#include <Arduino.h>
class Sensor
{
	public:
		Sensor(String name, char pin);
		char getPin();
		String getName();
		bool getState();
		virtual void check();
		
	protected:
		char _pin;
		String _name;
		bool _state;
		String _highMsg;
		String _lowMsg;
};

