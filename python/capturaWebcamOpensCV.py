import sys
import time
from time import strftime, gmtime
import _thread 
import requests
import cv2 as cv

def datahora():
    dt=strftime("%d/%m/%Y %H:%M:%S", gmtime())       
    return dt


def send_post():
        url = 'http://127.0.0.1/TI/projeto_it_greenhouse/api/api.php'        

        array_dados={
            'nome' : 'movimento',
            'valor' : '0',
            'hora': datahora()
        }
        
        r=requests.post(url, data = array_dados)
        #print(r.text)

        if r.status_code == 200:
            print ("OK: POST realizado com sucesso")
            print("Status:", r.status_code, "\n")

        else:
            print ("ERRO: Não foi possível realizar o pedido")
            print("Status:", r.status_code, "\n")


# iniciação da camara - WebCam


try :
    print( "Prima CTRL+C para terminar\n")

    currentFrame = 0

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
                print ("Resultado da Camera = \n" + str(ret))

                # reduzir o tamenho da imagem
                #img_resize = cv.resize(imgCap,(300,300))
                
                file = "../public/img/webcam/test_image_" + str(currentFrame) + ".jpg"
                cv.imwrite(file, imgCap) # grava a imagem em disco
                
                # Para não duplicar as imagens
                currentFrame += 1

                camera.release()
                cv.destroyAllWindows()
                #send_post() # tenatr arranjar outra maneira

            time.sleep (2)



except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")