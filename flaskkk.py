# memasukkan library flask, mariadb, dan time
from flask import Flask, request
import mariadb 
import time

app = Flask(__name__)

cnx = mariadb.connect( #membuat koneksi ke database
    host="localhost", #host database
    user="root", #username database
    password="", #password database
    database="honeywelldb" #nama database
)

@app.route('/tempHumidPOST', methods=['POST']) #membuat route untuk menerima data dari sensor
def receive_data():
    data = request.get_json()
    temp_C = data['temp_C'] #mengambil data temperatur dari sensor
    humidity = data['humidity'] #mengambil data kelembaban dari sensor

    try:
        with cnx.cursor() as cursor:
            sql = ("INSERT INTO labroom (Temp, Humid) VALUES (?, ?)") #memasukkan data ke database menggunakan query
            cursor.execute(sql, (temp_C, humidity))
            cnx.commit() #mengeksekusi query

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
