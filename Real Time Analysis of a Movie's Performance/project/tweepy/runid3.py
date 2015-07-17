import sys
import csv
import os

url = "/home/chintanpanchamia/project/movies/"
url_id3 = "/home/chintanpanchamia/project/decisiontrees-master/"
hashtag = sys.argv[1]
handle = open(url+'#'+hashtag+'/#'+hashtag+'_info.txt','r')
test_case = handle.readline().strip(" \n")
test_case_array = test_case.split(",") 
#print test_case
#print test_case_array
handle.close()

myfile = open(url+'#'+hashtag+'/#'+hashtag+'_info.csv', 'wb')
wr = csv.writer(myfile, quoting=csv.QUOTE_ALL)
wr.writerow(test_case_array)
myfile.close()

os.system('python '+url_id3+'id3.py '+url_id3+'example_data/Past.csv -t '+url+'#'+hashtag+'/#'+hashtag+'_info.csv')
os.system('cp '+url_id3+'parth.txt '+url+'#'+hashtag+'/#'+hashtag+'_prediction.txt')
os.system('rm '+url_id3+'parth.txt')
