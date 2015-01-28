#pragma once
#include "Sensor.h"

class Door : public Sensor
{
	public:
		Door(String name, int pin);
		void check();
		virtual void opened();
		virtual void leftOpened();
};

