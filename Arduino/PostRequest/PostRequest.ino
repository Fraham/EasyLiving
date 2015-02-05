#include <Ethernet.h>
#include <SPI.h>

char server[] = "easyliving.ml";

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x02 }; 
EthernetClient client;

void setup() 
{ 
	Serial.begin(9600);

	if (Ethernet.begin(mac) == 0) {
		Serial.println("Failed to configure Ethernet using DHCP"); 
		exit(0);
	}

}

void loop()
{

}

void sendMsg(String msg)
{
	String _msg = "msg=" + msg;
	if (client.connect(server, 80)) { 
		client.println("POST /post.php HTTP/1.1");
		client.println("Host: " + String(server));
		client.println("Content-Type: application/x-www-form-urlencoded");
		client.println("Connection: close");
		client.println("Content-Length: " + String(_msg.length()));
		client.println();
		client.print(_msg);
	}

	if (client.connected()) {
		client.stop();
	}

	Serial.println("Done!");

}