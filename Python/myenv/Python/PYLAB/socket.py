import socket

target = ""  # Replace with the actual target IP or hostname

for port in range(1, 10000):
    mySocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    mySocket.settimeout(1)  # Set timeout correctly on the socket instance
    result = mySocket.connect_ex((target, port))  # Proper tuple formatting

    if result == 0:
        print(f"PORT {port} IS OPEN")  # Fix print statement formatting

    mySocket.close()