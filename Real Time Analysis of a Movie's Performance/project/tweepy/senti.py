import nltk
import csv
import pickle

trainer = open('Sentiment Analysis Dataset.csv')

csv_trainer = csv.reader(trainer)



tweets = []
#for (words, sentiment) in pos_tweets + neg_tweets:
 #   words_filtered = [e.lower() for e in words.split() if len(e) >= 3] 
  #  tweets.append((words_filtered, sentiment))


for row in csv_trainer:
    words_filtered = [e.lower() for e in row[3].split() if len(e) >= 3] 
    if row[1] == '0':
        sentiment = 'negative'
    else:
        sentiment = 'positive'
    tweets.append((words_filtered, sentiment))


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

training_set = nltk.classify.apply_features(extract_features, tweets)

classifier = nltk.NaiveBayesClassifier.train(training_set)

print 'Done!!!!!'

f = open('my_classifier.pickle','wb')
pickle.dump(classifier,f)
f.close()