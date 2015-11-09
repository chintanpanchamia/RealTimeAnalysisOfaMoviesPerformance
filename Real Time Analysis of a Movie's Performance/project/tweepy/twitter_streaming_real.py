#Import the necessary methods from tweepy library
from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream

import sys #for command line arguments
import os #for terminal commands execution
import json
import nltk
import csv
import re
import subprocess
import pickle

url = "/home/chintanpanchamia/project/"

#Variables that contains the user credentials to access Twitter API 
access_token = "2793739158-pVYEiXZd90qMuXLsULyRfSuSQodVco3RXBXHk2H"
access_token_secret = "29pbt0iVYWOTiwCZGTy9xnCu87FdY4TsciSrvdnGEajIE"
consumer_key = "zcyBebO0dPSrBQXPlQlybk7bp"
consumer_secret = "aXjQXYoEGVVF4e0bRXDTnvc5DTsaw1NNpfksrhrPhDUf3ubMV2"

d = open('RAMP_tweets.pickle')
tweets = pickle.load(d)
d.close()

def get_words_in_tweets(tweets):
    all_words = []
    for (words, sentiment) in tweets:
      all_words.extend(words)
    return all_words

def get_word_features(wordlist):
    wordlist = nltk.FreqDist(wordlist)
    word_features = wordlist.keys()
    return word_features
  
def extract_features(document):
    document_words = set(document)
    features = {}
    for word in word_features:
        features['contains(%s)' % word] = (word in document_words)
    return features

word_features = get_word_features(get_words_in_tweets(tweets))    

f = open('RAMP_classifier.pickle')
classifier = pickle.load(f)
f.close()

north_zone = ["Jammu","New Delhi","Kashmir","Srinagar","Leh","Himachal Pradesh","Dharamsala","Kullu","Shimla","Punjab","Chandigarh","Ludhiana","Amritsar","Uttarakhand","Dehradun","Haridwar","Roorkee","Uttar Pradesh","Kanpur","Lucknow","Agra","Haryana","Chandigarh","Faridabad","Gurgaon"]
south_zone = ["Andhra Pradesh","Hyderabad","Visakhapatnam","Nellore","Karnataka","Bengaluru","Mysore","Mangalore","Kerala","Thiruvananthapuram","Kochi","Kozhikode","Tamil Nadu","Chennai","Coimbatore","Tiruchirappalli"]
east_zone = ["Bihar","Patna","Gaya","Muzaffarpur","Orissa","Bhubaneswar","Cuttack","Raurkela","Jharkhand","Jamshedpur","Dhanbad","Ranchi","West Bengal","Kolkata","Asansol","Shiliguri"]
west_zone = ["Rajasthan","Jaipur","Kota","Udaipur","Gujarat","Gandhinagar","Ahmedabad","Vadodara","Goa","Panaji","Madgaon","Mormugao","Maharashtra","Mumbai","Pune","Nagpur"]
northeast_zone = ["Assam","Dispur","Guwahati","Silchar","Sikkim","Gangtok","Nagaland","Kohima","Meghalaya","Shillong","Manipur","Imphal","Mizoram","Aizawl","Tripura","Agartala","Arunachal Pradesh","Itanagar"]
central_zone = ["Madhya Pradesh","Indore","Bhopal","Jabalpur","Chhattisgarh","Raipur","Bhilai","Bilaspur"]

def call_senti(movie_parameter):
	os.system('cp '+url+'movies/'+movie_parameter+'/'+movie_parameter+'_full.txt '+url+'movies/'+movie_parameter+'/'+movie_parameter+'_full_senti.txt')
	open(url+'movies/'+movie_parameter+'/'+movie_parameter+'_full.txt', 'w').close()
	movie_tweet_count[movie_parameter] = sum(1 for line in open('/home/chintanpanchamia/project/movies/'+movie_parameter+'/'+movie_parameter+'_full.txt'))
	senti_handle = open(url+'movies/'+ movie_parameter +'/'+ movie_parameter +'_full_senti.txt', 'r')
	extremely_positive_count = 0
	positive_count = 0
	neutral_count = 0
	negative_count = 0
	extremely_negative_count = 0
	north_count = 0
	south_count = 0
	east_count = 0
	west_count = 0
	northeast_count = 0
	central_count = 0
	for i in range(0,50):
		full_line = senti_handle.readline()
		m = re.search('Text:(.+?)location:', full_line)
		if m:
			text_part = m.group(1)
			text_part = text_part.strip(' \t\n')
		else:
			print 'Text nai mila'
		n = re.search('location:(.+?)datetime:', full_line)
		if n:
			location_part = n.group(1)
			location_part = location_part.strip(' \t\n')
		else:
			print 'Location nai mila'
		x = classifier.classify(extract_features(text_part.split()))
		if x == 'extremely positive': extremely_positive_count = extremely_positive_count + 1
		if x == 'positive': positive_count = positive_count + 1
		if x == 'neutral': neutral_count = neutral_count + 1
		if x == 'negative': negative_count = negative_count + 1
		if x == 'extremely negative': extremely_negative_count = extremely_negative_count + 1
		handle_to_write_senti = open(url+'movies/'+movie_parameter+'/'+movie_parameter+'_full_with_senti.txt','a')
		handle_to_write_senti.write(full_line+'Sentiment:'+x+'\n')
		handle_to_write_senti.close()
		if location_part in north_zone:
			north_count = north_count + 1
		if location_part in south_zone:
			south_count = south_count + 1
		if location_part in east_zone:
			east_count = east_count + 1
		if location_part in west_zone:
			west_count = west_count + 1	
		if location_part in northeast_zone:
			northeast_count = northeast_count + 1
		if location_part in central_zone:
			central_count = central_count + 1
	senti_handle.close()		
	geo_handle = open(url+'movies/'+movie_parameter+'/'+movie_parameter+'_geo.txt', 'a')
	geo_handle.write(''+str(north_count)+' '+str(south_count)+' '+str(east_count)+' '+str(west_count)+' '+str(northeast_count)+' '+str(central_count)+'\n')
	geo_handle.close()
	pos_neg_handle = open(url+'movies/'+movie_parameter+'/'+movie_parameter+'_pos_neg.txt', 'a')
	pos_neg_handle.write(''+str(extremely_positive_count)+' '+str(positive_count)+' '+str(neutral_count)+' '+str(negative_count)+' '+str(extremely_negative_count)+'\n')
	pos_neg_handle.close()
	#p = subprocess.Popen(['python', 'graph.py'], stdout=subprocess.PIPE, stderr=subprocess.STDOUT)

#This is a basic listener that just prints received tweets to stdout.
class StdOutListener(StreamListener):

	def on_data(self, data):
		decoded = json.loads(data)
		location = decoded['user']['time_zone']
		if location is None:
			location = "Null"
		datetime = decoded['created_at']
		for movie in movie_list_array:
			if decoded['text'].lower().find(movie.lower()) != -1:
				movie_tweet_count[movie] = movie_tweet_count[movie] + 1
				text_string = decoded['text'].encode('ascii','ignore')
				print movie+':'+text_string
				text_string = text_string.replace("\n"," ")
				text_string = text_string.strip(' \t\n')
				temp_handle = open(url+'movies/'+movie+'/'+movie+'.txt' , 'a')
				temp_handle.write(text_string+'\n')
				temp_handle.close()
				temp_handle = open(url+'movies/'+movie+'/'+movie+'_full.txt' , 'a')
				temp_handle.write("Text:"+text_string+'\tlocation:'+location+'\tdatetime:'+datetime+'\n')
				temp_handle.close()
				break	
		for movie in movie_list_array:
			if movie_tweet_count[movie] == 50:
				call_senti(movie)
		return True

	def on_error(self, status):
		print status


if __name__ == '__main__':

	#This handles Twitter authetification and the connection to Twitter Streaming API
	l = StdOutListener()
	auth = OAuthHandler(consumer_key, consumer_secret)
	auth.set_access_token(access_token, access_token_secret)
	stream = Stream(auth, l)

	#Open input file and transfer to old file
	handle = open(url+'repository/movie_input.txt', 'r')
	#handle_write = open(url+'repository/movie_old.txt','a')
	movie_list = handle.readline()
	#print movie_list
	movie_list_array = movie_list.split()
	movie_tweet_count = {}
	for movie in movie_list_array:
		if (os.path.isdir(url+"movies/%s"% movie) == False):
			os.system("mkdir "+url+"movies/%s"% movie)
			handle_open = open(url+'movies/'+movie+'/'+movie+'_full.txt' , 'a')
			handle_open.close()
			handle_open = open(url+'movies/'+movie+'/'+movie+'.txt' , 'a')
			handle_open.close()
			handle_open = open(url+'movies/'+movie+'/'+movie+'_full_with_senti.txt' , 'a')
			handle_open.close()
			handle_open = open(url+'movies/'+movie+'/'+movie+'_geo.txt' , 'a')
			handle_open.close()
			handle_open = open(url+'movies/'+movie+'/'+movie+'_pos_neg.txt' , 'a')
			handle_open.close()
		movie_tweet_count[movie] = sum(1 for line in open('/home/chintanpanchamia/project/movies/'+movie+'/'+movie+'_full.txt'))		
	handle.close()

	#This line filter Twitter Streams to capture data by the keywords: 'python', 'javascript', 'ruby'
	stream.filter(track=movie_list_array, languages=["en"])
