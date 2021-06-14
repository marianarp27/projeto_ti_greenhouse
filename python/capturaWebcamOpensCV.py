import sys
import time
from time import strftime, gmtime
import _thread 
import requests
import cv2 as cv

# defenição da data/hora para o POST
def datahora():
    dt=strftime("%d/%m/%Y %H:%M:%S", gmtime())       
    return dt

#vai buscar o data/hora para inserir no nome da imagem para não duplicar as mesmas
def getTimeImg():
    hora=strftime("%d-%m-%Y_%H-%M-%S", gmtime())       
    return hora


def send_post(img):
        url = 'http://127.0.0.1/TI/projeto_it_greenhouse/api/api.php'        

        array_dados={
            'nome' : 'camara',
            'valor' : img,
            'hora': datahora()
        }
        
        r=requests.post(url, data = array_dados)
        print(r.text)

        if r.status_code == 200:
            print ("OK: POST realizado com sucesso")
            print("Status:", r.status_code, "\n")

        else:
            print ("ERRO: Não foi possível realizar o pedido")
            print("Status:", r.status_code, "\n")


try :
    print( "Prima CTRL+C para terminar\n")


    while True: # ciclo para o programa executar sem parar…

        r=requests.get('http://127.0.0.1/TI/projeto_it_greenhouse/api/api.php?nome=movimento')

        if r.status_code == 200:
            print( "*** LER Sensor Movimento do servidor ***")
            print("Valor:", r.json(), "\n")

            # se for detetado algum movimento
            if r.json() == 1: 

                 # cv.CAP_DSHOW -> para não aparecer o warning de 'anonymous-namespace'
                camera = cv.VideoCapture(0, cv.CAP_DSHOW)
               
                # Tira uma imagem - webcam
                ret, imgCap = camera.read()
                print ("Resultado da Camera = " + str(ret))
                
                fileName = "camara_" + str(getTimeImg()) + ".jpg" #cria o nome da imagem a partir da data/hora
                file = "../public/img/webcam/" + str(fileName)  # caminho para o armanezamento da imagem
                cv.imwrite(file, imgCap) # grava a imagem em disco

                camera.release()
                cv.destroyAllWindows()

                #caminho da imagem para enviar via POST
                fileImg = "public/img/webcam/" + fileName
                send_post(fileImg) # enviar a imagem para a Base de Dados (POST)

            time.sleep (5) #espera 5 segundos



except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")