#Import the necessary methods from tweepy library
from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream

#Variables that contains the user credentials to access Twitter API 
access_token = "2793739158-pVYEiXZd90qMuXLsULyRfSuSQodVco3RXBXHk2H"
access_token_secret = "29pbt0iVYWOTiwCZGTy9xnCu87FdY4TsciSrvdnGEajIE"
consumer_key = "zcyBebO0dPSrBQXPlQlybk7bp"
consumer_secret = "aXjQXYoEGVVF4e0bRXDTnvc5DTsaw1NNpfksrhrPhDUf3ubMV2"


#This is a basic listener that just prints received tweets to stdout.
class StdOutListener(StreamListener):

    def on_data(self, data):
        print data
        return True

    def on_error(self, status):
        print status


if __name__ == '__main__':

    #This handles Twitter authetification and the connection to Twitter Streaming API
    l = StdOutListener()
    auth = OAuthHandler(consumer_key, consumer_secret)
    auth.set_access_token(access_token, access_token_secret)
    stream = Stream(auth, l)

    #This line filter Twitter Streams to capture data by the keywords: 'python', 'javascript', 'ruby'
    response = stream.filter(track=['Alone'])

