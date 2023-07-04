from flask import Flask, request
import mariadb
import time

app = Flask(__name__)

cnx = mariadb.connect(
    host="localhost",
    user="root",
    password="",
    database="honeywelldb"
)

@app.route('/tempHumidPOST', methods=['POST'])
def receive_data():
    data = request.get_json()
    temp_C = data['temp_C']
    humidity = data['humidity']

    try:
        with cnx.cursor() as cursor:
            sql = ("INSERT INTO labroom (Temp, Humid) VALUES (?, ?)")
            cursor.execute(sql, (temp_C, humidity))
            cnx.commit()

            if cnx.is_connected():
                print("Connected to MariaDB server")
            else:
                print("Connection failed")

            print(f"Temperature: {temp_C}, Humidity: {humidity}")

            return "Data received"
    except:
        return "Error"


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)


#curl -X GET http://192.168.1.13:5000/data
#curl -X POST http://192.168.1.13:5000/switchPOST -H "Content-Type: application/json" --data "{\"light_status\":\"ON\",\"status_int\":\"1\"}"

#14:38:14.292 -> 1C D9 8D 64 

#14:38:17.757 -> B0 83 B8 21 
