
import requests
import json
import os

os.environ['NO_PROXY'] = '127.0.0.1'
ip = "127.0.0.1:8080"

spr = f"/API/Controllers/"
cookie = "PHPSESSID=rnvvotgv3cm6cq13ev2urjpb35"

def loadsJson(txt):
  jsonData = {
    "Error": "Some error!"
  }
  try:
    jsonData = json.loads(txt)
  except:
    print(txt)
    exit()
  return jsonData

def getREST(link, cookie):
  response = requests.get(link, headers={"Cookie": cookie})
  return loadsJson(response.text)


  