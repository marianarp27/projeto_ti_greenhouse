import sys
import time

import requests
import cv2 as cv


try :
    print( "Prima CTRL+C para terminar")
    


    while True: # ciclo para o programa executar sem parar…

        url = 'http://127.0.0.1/TI/LAB_IT/assets/api/api.php' 

        files = {'file': open('report.xls', 'rb')}

        r=requests.post(url, files=files)
        
        camera = cv.VideoCapture(0)
        ret, image = camera.read()
        print ("Resultado da Camera=" + str(ret))
        
        cv.imwrite('webcam.jpg', image)
        
        camera.release()
        cv.destroyAllWindows()

        time.sleep (5)
        
        #img = cv.imread('opencv_image.png', 0)
        #cv.imshow('Imagem', img)
        #cv.waitKey(5000)
        #cv.waitKey(0) & 0xFF == ord('s')
        #cv.imwrite('opencv_image_gray.png', img)
        #cv.destroyAllWindows()

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")