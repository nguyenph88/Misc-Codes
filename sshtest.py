from sshtunnel import SSHTunnelForwarder

server = SSHTunnelForwarder(
ssh_address=('64.161.36.200', 22),
ssh_username="admin",
ssh_password="default",
remote_bind_address=("127.0.0.1", 1080))

server.start()

print(server.local_bind_port)
