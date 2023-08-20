import mariadb 
import time
import random

cnx = mariadb.connect( #membuat koneksi ke database
    host="localhost", #host database
    user="root", #username database
    password="", #password database
    database="honeywelldb" #nama database
)

def randomData():
    temp_C = random.randint(10, 36)
    humidity = random.randint(0, 100)
    return temp_C, humidity

def sendData(temp_C, humidity):
    try:
        with cnx.cursor() as cursor:
            sql = ("INSERT INTO labroom (Temp, Humid) VALUES (?, ?)") #memasukkan data ke database menggunakan query
            cursor.execute(sql, (temp_C, humidity))
            cnx.commit() #mengeksekusi query


            return "Data received" 
    except:
        return "Error"

while True:
    temp_C, humidity = randomData()
    sendData(temp_C, humidity)
    print("Data sent")
    time.sleep(1)