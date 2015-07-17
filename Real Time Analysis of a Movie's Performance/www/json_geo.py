#!/usr/bin/env python

import sys
import os
from operator import add

hashtag = sys.argv[1]
count_array = [0,0,0,0,0,0]
handle = open('/home/parthrparekh93/project/movies/#'+hashtag+'/#'+hashtag+'_geo.txt','r')
for line in handle:
	temp_array = line.split()
	temp_array = [int(x) for x in temp_array]
	count_array = map(add, count_array, temp_array)
handle.close()
json_text = "[{'iso2':'IN_JK','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_HP','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_PB','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_UT','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_UP','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_HR','size':"+str(count_array[0])+",'color':'yellow','tooltip':'north'},{'iso2':'IN_AP','size':"+str(count_array[1])+",'color':'yellow','tooltip':'south'},{'iso2':'IN_KA','size':"+str(count_array[1])+",'color':'yellow','tooltip':'south'},{'iso2':'IN_KL','size':"+str(count_array[1])+",'color':'yellow','tooltip':'south'},{'iso2':'IN_TN','size':"+str(count_array[1])+",'color':'yellow','tooltip':'south'},{'iso2':'IN_BR','size':"+str(count_array[2])+",'color':'yellow','tooltip':'east'},{'iso2':'IN_OR','size':"+str(count_array[2])+",'color':'yellow','tooltip':'east'},{'iso2':'IN_JH','size':"+str(count_array[2])+",'color':'yellow','tooltip':'east'},{'iso2':'IN_WB','size':"+str(count_array[2])+",'color':'yellow','tooltip':'east'},{'iso2':'IN_RJ','size':"+str(count_array[3])+",'color':'yellow','tooltip':'west'},{'iso2':'IN_GJ','size':"+str(count_array[3])+",'color':'yellow','tooltip':'west'},{'iso2':'IN_GA','size':"+str(count_array[3])+",'color':'yellow','tooltip':'west'},{'iso2':'IN_MH','size':"+str(count_array[3])+",'color':'yellow','tooltip':'west'},{'iso2':'IN_AS','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_MN','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_ML','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_MZ','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_NL','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_SK','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_TR','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_AR','size':"+str(count_array[4])+",'color':'yellow','tooltip':'northeast'},{'iso2':'IN_CT','size':"+str(count_array[5])+",'color':'yellow','tooltip':'central'},{'iso2':'IN_MP','size':"+str(count_array[5])+",'color':'yellow','tooltip':'central'}]"
json_text = json_text.replace('\'','\"')
handle = open(hashtag+'.json', 'w')
handle.write(json_text)
handle.close()
print "json_geo.py working fine"