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
		void debounce(long last);
		void interrupted();
		void call();
		long _last;
		
	protected:
		int _pin;
		String _id;
		bool _state;
		
		int _debounceDelay;
};

