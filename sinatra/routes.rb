require 'sinatra'
require 'socket'

host = '192.168.1.113'
port = 80


post '/lamp/' do
  s = TCPSocket.open(host, port)
	puts "Light was turned on"
	s.puts("#{params[:command]}\n")
	s.close
	
end

get '/' do
  erb :index
end

# not_found do
#   halt 404, "Page not found!"
# end