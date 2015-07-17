import os

url = "/home/chintanpanchamia/project/"

handle = open(url+'repository/movie_input.txt', 'r')
handle_write = open(url+'repository/movie_old.txt','a')
movie_list = handle.readline()
os.system("sed -i '1d' "+url+"repository/movie_input.txt")
handle_write.write(movie_list)
handle_write.close()
handle.close()

movie_list_array = movie_list.split()
for movie in movie_list_array:
		if (os.path.isfile("/var/www/pro/"+movie[1:]+".php") == False):
			open('/var/www/pro/'+movie[1:]+'.php','w').close()
			os.system('chmod 777 /var/www/pro/'+movie[1:]+'.php')
			
