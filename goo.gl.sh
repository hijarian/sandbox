#!/bin/sh

curl 'https://www.googleapis.com/urlshortener/v1/url' \
  -H 'Content-Type: application/json' \
  -d "{\"longUrl\": \"$1\", \"key\": 'AIzaSyBCAnt54VYmcOe38XfOtVk724l0xySTVNk'}"
