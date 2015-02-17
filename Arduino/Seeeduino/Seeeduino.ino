#include <SPI.h>
#include <Ethernet.h>
#include "Sensor.h"
#include "Fridge.h"
#include "PIR.h"
#include "Conn.h"

Sensor *sensors[] = { 
	new Door("Door", 5),
	new Fridge("Fridge", 6, 7),
	new PIR("Motion1", 3),
};
int sensorCount = sizeof(sensors) / sizeof(*sensors);

void setup() 
{
	Serial.begin(9600);
	connInit();
}

void loop()
{
	for (int i = 0; i < sensorCount; i++)
		(*sensors[i]).check();
	getResponse();
}
