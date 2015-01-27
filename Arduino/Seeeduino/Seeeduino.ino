typedef struct{
	String name;
	int pin;
	int state;
}stateSens;

stateSens mgSens[] = {
	{ "Fridge", 6, 1 },
	{ "Door", 5, 1 },
};
int mgSensCount = sizeof(mgSens) / sizeof(stateSens);

stateSens pirSens[] = {
	{ "Main", 3, 1 },
};
int pirSensCount = sizeof(mgSens) / sizeof(stateSens);

void setup() {
	Serial.begin(9600);
	for (int i = 0; i<mgSensCount; i++)
	{
		pinMode(mgSens[i].pin, INPUT);
	}
}

void loop()
{
	mgSensCheck();
	pirSensCheck();
}

void mgSensCheck()
{
	for (int i = 0; i<mgSensCount; i++)
	{
		if (digitalRead(mgSens[i].pin) && !mgSens[i].state)
		{
			Serial.print(mgSens[i].name);
			Serial.println(" opened!");
			mgSens[i].state = 1;
		}
		if (!digitalRead(mgSens[i].pin) && mgSens[i].state)
		{
			Serial.print(mgSens[i].name);
			Serial.println(" closed!");
			mgSens[i].state = 0;
		}
	}
}

void pirSensCheck()
{
	for (int i = 0; i<pirSensCount; i++)
	{
		if (digitalRead(pirSens[i].pin) && !pirSens[i].state)
		{
			Serial.print(pirSens[i].name);
			Serial.println(": movement detected!");
			pirSens[i].state = 1;
		}
		if (!digitalRead(pirSens[i].pin) && pirSens[i].state)
		{
			Serial.print(pirSens[i].name);
			Serial.println(": movement stopped!");
			pirSens[i].state = 0;
		}
	}
}


