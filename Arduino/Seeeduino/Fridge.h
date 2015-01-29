#pragma once
#include "Door.h"

class Fridge :	public Door
{
	public:
		Fridge(String name, int pin, int buzzPin);
		void opened();
		void leftOpened();
	protected:
		unsigned long _openTime;
		unsigned long _switchTime;
		int _buzzPin;
		bool _buzzState;
};

