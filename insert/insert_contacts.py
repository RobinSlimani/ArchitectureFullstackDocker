import mysql.connector
from mysql.connector import Error

def insert_contacts():
    try:
        connection = mysql.connector.connect(
            host='my-mysql-container',  
            database='contacts_db',
            user='root',
            password='root'  
        )

        if connection.is_connected():
            cursor = connection.cursor()

            # Insertion des données
            insert_query = """
            INSERT INTO contacts (nom, prenom, email, telephone)
            VALUES (%s, %s, %s, %s)
            """
            contacts = [
                ('Doe', 'John', 'john.doe@example.com', '1234567890'),
                ('Smith', 'Jane', 'jane.smith@example.com', '0987654321'),
                
            ]

            cursor.executemany(insert_query, contacts)
            connection.commit()

            print(f"{cursor.rowcount} ligne(s) insérée(s).")

    except Error as e:
        print("Erreur lors de la connexion à MySQL", e)
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

if __name__ == "__main__":
    insert_contacts()

