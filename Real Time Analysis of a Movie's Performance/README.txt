Real Time Analysis of a Movie's Performance

Contents:
1) Python installer file
2) Project directory
3) Www directory (Has to be stored in a directory which can be accessed via localhost)

Contents of Project Directory:
1) decisiontrees-master directory (This directory stores the ID3 implementation code)
2) movies directory (This directory stores all the movie directories)
	a) moviename.txt - This file stores the tweet text of that movie
	b) moviename_full.txt - This file stores the tweet text along with the location and datetime of the tweet
	c) moviename_full_senti.txt - This file stores the current 50 tweets which are being analyzed by sentiment analyzer
	d) moviename_full_with_senti.txt - This file stores all the tweets which have been analyzed along with the sentiment
	e) moviename_geo.txt - Stores the number of tweets according to the location (Divided into 6 indian zones)
	f) moviename_info.csv - Stores the movie info to be given to id3 implementation code
	g) moviename_info.txt - Stores the complete info of the movie which is given as input by the admin via webpage
	h) moviename_pos_neg.txt - Stores the number of tweets according to the sentiment
	i) moviename_prediction.txt - Stores the prediction which is the output of id3 implementation code
3) repository directory (This directory stores the hashtags to be searched on a line per week basis and also the hashtag archive file)
4) tweepy directory (This directory stores some important codes to be executed)
	a) twitter_streaming_real.py - extracts and filters twitter data and stores them in their respective directories
	b) runid3.py - runs the id3 implementation code and stores prediction
	c) pickle files (RAMP_tweets and RAMP_classifier) - useful for storing complex datatypes (trained classifier in this case)
	d) input_change.py - changes the hashtag to be searched (have to be run once every week)

Contents of Www Directory:
1) pro directory
	a) Admin php pages
	b) Movie php pages
	c) Resources(Images for movie pages as well as contact us page)
	d) Css and js directories used for the website
2) pykih-charts directory (This directory is used for the Indian map display)
3) sample JSON files of tested movies
4) json_geo.py - takes hashtag as a parameter (Without the hashtag for eg. #NH10 will be passed NH10 as a parameter while running) and calculates the tweets location-wise to store it in a JSON file5) php_maker.py - takes hashtag as a parameter (Same manner as above) and automatically creates php pages
6) pykcharts css and js files


Important points : 
	1) Change the file paths accordingly in codes. (Would have to change the variables in beginning of every code)