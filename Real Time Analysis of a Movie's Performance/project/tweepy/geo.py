import sys

north_zone = []
south_zone = []
east_zone = []
west_zone = []
northeast_zone = []
central_zone = []

north_count = 0
south_count = 0
east_count = 0
west_count = 0
northeast_count = 0
central_count = 0

location_part = sys.argv[1]

if location_part in north_zone:
	north_count = north_count + 1
if location_part in south_zone:
	south_count = south_count + 1
if location_part in east_zone:
	east_count = east_count + 1
if location_part in west_zone:
	west_count = west_count + 1			