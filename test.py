# Client program

from socket import *
import time

# Set the socket parameters
host = "192.168.1.113"
port = 80
addr = (host, port)


# Create socket
sock = socket(AF_INET,SOCK_STREAM)

sock.connect(addr)

delay = .03

# Send messages
for i in range(0,20):
	time.sleep(delay)
	sock.send("RO\n")
	time.sleep(delay)
	sock.send("RX\n")

# Close socket
sock.close()
