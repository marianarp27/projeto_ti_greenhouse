#!/usr/bin/python
import sys, requests
from time import strftime, gmtime
from msvcrt import kbhit, getch

#strftime:   Converte a data e a hora para formato string
#gmtime:     Converte a data e a hora expresso em segundos para o fuso horário UTC
#kbhit :     Detecta uma tecla pressionada
#getch:      Guarda o valor da tecla pressionada

try :
    #print( "Prima CTRL+C para terminar \n")    
    print ("Usage:\n[0]Fecha a porta\n[1]Abre a porta\n[CTRL+C]Terminar")

    def datahora():
        dt=strftime("%d/%m/%Y %H:%M:%S", gmtime())       
        return dt

    
    #nome = "porta"
    def send_to_api(nome,valor):
        url = 'http://127.0.0.1/TI/projeto_it_greenhouse/api/api.php'        

        array_dados={
            'nome' : nome,
            'valor' : valor,
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


    while True:
        
        if kbhit():
            valorInsert = getch()
            #print (valorInsert)

            if valorInsert == b'0':
                valor=valorInsert
                nome = "porta"
                send_to_api(nome,valor)
                print("***Porta foi Fechada***\n\n")
            elif valorInsert == b'1':
                valor=valorInsert
                nome = "porta"
                send_to_api(nome,valor)
                print("***Porta foi Aberta***\n\n")
            else:
                print("\nOpção inválida!")

        
        #send_to_api(url,nome,valor)

except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")