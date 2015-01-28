#pragma once
#include "Door.h"

struct Buzzer{
	char pin;
	bool state;
};


class Fridge :	public Door
{
	public:
		Fridge(String name, char pin, char buzzPin);
		void opened();
		void leftOpened();
	protected:
		unsigned long _openTime;
		unsigned long _switchTime;
		bool _waitTime;
		int _timer;
		int _freq;
		char _buzzPin;
		Buzzer _buzzer;
};

