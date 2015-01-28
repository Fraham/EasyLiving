#include "Sensor.h"
#include "Fridge.h"
#include "PIR.h"

Sensor sensors[] = { 
	Door("Door", 5),
	Fridge("Fridge", 6, 7),
	PIR("Motion1", 3),
};
int sensorCount = sizeof(sensors) / sizeof(*sensors);

void setup() {
	Serial.begin(9600);
}

void loop()
{
	for (int i = 0; i < sensorCount; i++)
		sensors[i].check();
}
