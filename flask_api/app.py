from flask import Flask, request, jsonify
from transformers import AutoTokenizer, AutoModelForSeq2SeqLM

app = Flask(__name__)

# Load the T5 model and tokenizer
model_name = "pszemraj/long-t5-tglobal-base-16384-book-summary"
tokenizer = AutoTokenizer.from_pretrained(model_name)
model = AutoModelForSeq2SeqLM.from_pretrained(model_name)

# Define a route for generating book summaries
@app.route('/summarize', methods=['POST'])
def summarize():
    # Get the book text from the request
    data = request.get_json()
    text = data.get('text')
    if text :
        # do something 
        pass
    text = request.json['text'] # here better to use get and also first use request.get_json()

    # Generate a summary using the T5 model
    inputs = tokenizer.encode("summarize: " + text, return_tensors="pt", max_length=4096, truncation=True)
    summary_ids = model.generate(inputs, max_length=512, min_length=20, length_penalty=2.0, num_beams=4, early_stopping=True)
    summary = tokenizer.decode(summary_ids[0], skip_special_tokens=True)

    # Return the summary as JSON
    return jsonify({'summary': summary})

if __name__ == '__main__':
    app.run(debug=True)