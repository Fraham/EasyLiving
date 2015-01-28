#pragma once
#include "Sensor.h"

class Door : public Sensor
{
	public:
		Door(String name, char pin);
		void check();
		virtual void opened();
		virtual void leftOpened();
};

