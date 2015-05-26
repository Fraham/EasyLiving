#include <Ethernet.h>
#include <SPI.h>

char serverAddr[] = "easyliving.ml";
byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x02 };
EthernetClient server;
int buzzerPin = 8;
String arduinoID = "100001";

void connInit()
{
	if (Ethernet.begin(mac) == 0) 
	{
		Serial.println("Failed to configure Ethernet using DHCP");
		exit(0);
	}
	Serial.println("Ready!");
	tone(buzzerPin, 500);
	delay(200);
	noTone(buzzerPin);
}

void post(String id, String msg)
{
	String _id = "id=" + id;
	String _msg = "&msg=" + msg;
	if (server.connect(serverAddr, 80)) {
		server.println("POST /post.php HTTP/1.1");
		server.println("Host: " + String(serverAddr));
		server.println("Content-Type: application/x-www-form-urlencoded");
		server.println("Connection: close");
		server.println("Content-Length: " + String(_id.length()) + String(_msg.length()));
		server.println();
		server.print(_id + _msg);
		Serial.println(_id + _msg);
	}
}

void sendMsg(String id, String msg)
{
	post(id, msg);
	server.stop();
}

void sendMsg(String id, int msg)
{
	post(id, String(msg));
	server.stop();
}

String getResponse()
{
	//post(arduinoID, "request");
        String _id = "id=100001";
	String _msg = "&msg=request";
	if (server.connect(serverAddr, 80)) {
		server.println("POST /post.php HTTP/1.1");
		server.println("Host: " + String(serverAddr));
		server.println("Content-Type: application/x-www-form-urlencoded");
		//server.println("Connection: close");
		server.println("Content-Length: " + String(_id.length()) + String(_msg.length()));
		server.println();
		server.print(_id + _msg);
		Serial.println(_id + _msg);
	}
	String response = "";
	if (server.available())
	{
		while (server.available())
		{
			char c = server.read();
			response += c;
		}
		response = response.substring(248);
		Serial.println(response);
		server.stop();
 	}
 return response;
}


