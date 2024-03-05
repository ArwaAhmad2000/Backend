import requests

url = 'http://127.0.0.1:5000/summarize'
headers = {
    'Content-Type': 'application/json'
}
data = {
    'text': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...'
}
response = requests.post(url, headers=headers, json=data)

summary = response.json()['summary']