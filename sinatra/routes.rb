require 'sinatra'
require 'socket'

host = '192.168.1.133'
port = 50007


post '/lamp/' do
  s = TCPSocket.open(host, port)
	puts "Light was turned on"
	s.puts("#{params[:command]}\n")
	s.close
	
	redirect to('/')
	
end

get '/' do
  erb :index
end

get '/switch/' do
  
  puts "Testing..."
  
  s = TCPSocket.open('192.168.1.106', 80)
  
  s.puts("RS\n")
    
  while line = s.gets
      puts line.chop
  end
  
  s.close
  
  
end


# not_found do
#   halt 404, "Page not found!"
# end