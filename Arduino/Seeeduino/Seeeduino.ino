#include <SPI.h>
#include <Ethernet.h>
#include "DHT.h"
#include <EnableInterrupt.h>
#include "Sensor.h"
#include "Conn.h"

#define DHTPIN 8
#define DHTTYPE DHT22   // DHT 22  (AM2302)

DHT dht(DHTPIN, DHTTYPE);

//Sensor *sensors[] = { 
//	new Door("020001", 5),
//	new Fridge("020051", 6),
//};
// int sensorCount = sizeof(sensors) / sizeof(*sensors);

long dhtLastTime = 0;

Sensor door = Sensor("020001", 5);
Sensor fridge = Sensor("020051", 6);
Sensor button = Sensor("070001", 7); 

void iPin5(){door.debounce(door._last);}
void iPin6(){fridge.debounce(fridge._last);}
void iPin7(){button.debounce(button._last);}

void setup() 
{
	Serial.begin(9600);
	connInit();
	dht.begin();

	enableInterrupt(5, iPin5, CHANGE);
	enableInterrupt(6, iPin6, CHANGE);
	enableInterrupt(7, iPin7, CHANGE);
	//DHT = pin 8
        
}

void sendDHT()
{
  int hum = dht.readHumidity();
  int temp = dht.readTemperature();
  if (isnan(hum) || isnan(temp)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  sendMsg("030001", " &temp="+String(temp)+"&hum="+String(hum));
}

void loop()
{

	if(millis() - dhtLastTime > 300000)
	{
		sendDHT();
		dhtLastTime = millis();
	}

	//getResponse();
        
}



