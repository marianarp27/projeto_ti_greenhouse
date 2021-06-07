import sys
import time

import requests
import simpleaudio

try :
    print( "Prima CTRL+C para terminar")
    

    def play_sound(ficheiro):
        wave_obj = simpleaudio.WaveObject.from_wave_file(ficheiro)
        play_obj = wave_obj.play() # tocar o audio
        play_obj.wait_done() # espera ate o audio terminar 

    while True: # ciclo para o programa executar sem parar…
        print( "*** LER temperatura do servidor ***")
        r=requests.get('http://127.0.0.1/TI/projeto_it_greenhouse/api/api.php?nome=temperatura')
        #print("Valor é:", r.json(), "\n")
        #print("Status:", r.status_code)
            
        if r.status_code == 200:
            print("Valor é:", r.json(), "\n")

            if r.json() > 20:
                print("Temperatura HIGH:", r.json(), "\n")
                play_sound("../Alarm.wav") # chamar a função criada
            else:
                print("Temperatura LOW:", r.json(), "\n")

        else:
            print("O pedido HTTP não foi bem sucedid")

        time.sleep (2)

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")