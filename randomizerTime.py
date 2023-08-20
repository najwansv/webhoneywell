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

def sendData(temp_C, humidity, time):
    try:
        with cnx.cursor() as cursor:
            sql = ("INSERT INTO labroom (Temp, Humid, idTime) VALUES (?, ?, ?)") #memasukkan data ke database menggunakan query
            cursor.execute(sql, (temp_C, humidity, time))
            cnx.commit() #mengeksekusi query


            return "Data received" 
    except:
        return "Error"

while True:
    times = ["240000","010000","020000","030000","040000","050000","060000","070000","080000","090000","100000","110000","120000","130000","140000","150000","160000","170000","180000","190000","200000","210000","220000","230000"]
    for i in range(len(times)):
        temp_C, humidity = randomData()
        sendData(temp_C, humidity, times[i])
        print("Temperature:"+str(temp_C)+", Humidity:"+str(humidity)+", Time:"+ str(times[i]))
        print("Data sent")
        time.sleep(1)