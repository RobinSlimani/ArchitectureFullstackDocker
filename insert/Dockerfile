FROM python:3.9-slim

RUN pip install mysql-connector-python

# Copier le script Python dans le conteneur
COPY insert_contacts.py /insert_contacts.py

CMD sleep 15 && python3 insert_contacts.py
