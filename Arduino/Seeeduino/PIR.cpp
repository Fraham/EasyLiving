#include "PIR.h"


PIR::PIR(String name, char pin) : Door(name, pin)
{
	_highMsg = ": movement detected!";
	_lowMsg = ": movement stopped!";
}

