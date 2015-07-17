import json
tweets = []

for line in open('data3.txt'):
  try: 
    tweets.append(json.loads(line))
  except:
    pass

print len(tweets)

ids = [tweet['id_str'] for tweet in tweets]
texts = [tweet['text'] for tweet in tweets]
times = [tweet['created_at'] for tweet in tweets]
screen_names = [tweet['user']['screen_name'] for tweet in tweets]
names = [tweet['user']['name'] for tweet in tweets]

print texts
#print screen_names
