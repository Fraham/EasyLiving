#include "PIR.h"


PIR::PIR(String name, int pin) : Door(name, pin)
{
	_highMsg = ": movement detected!";
	_lowMsg = ": movement stopped!";
}

