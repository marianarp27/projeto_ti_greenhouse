#!/usr/bin/python
import sys, requests
from time import strftime, gmtime
from msvcrt import kbhit, getch

#strftime:   Converte a data e a hora para formato string
#gmtime:     Converte a data e a hora expresso em segundos para o fuso horário UTC
#kbhit :     Detecta uma tecla pressionada
#getch:      Guarda o valor da tecla pressionada

try : 
    print ("Usage:\n[0] Desliga a rega\n[1] Liga a rega\n[CTRL+C] Terminar")

    #defenição da data e hora do sistema
    def datahora():
        dt=strftime("%d/%m/%Y %H:%M:%S", gmtime())       
        return dt

    # código que manda para a API -- POST
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
            #vai ler o valor inserido pelo user
            valorInsert = getch()
            #print (valorInsert)

            if valorInsert == b'0':
                valor="0"
                nome = "rega"
                send_to_api(nome,valor)
                print("***Rega foi Desligada***\n\n")
                print ("Usage:\n[0] Desliga a rega\n[1] Liga a rega\n[CTRL+C] Terminar")

            elif valorInsert == b'1':
                valor="1"
                nome = "rega"
                send_to_api(nome,valor)
                print("***Rega foi Ligada***\n\n")
                print ("Usage:\n[0] Desliga a rega\n[1] Liga a rega\n[CTRL+C] Terminar")
            else:
                print("\nOpção inválida!")


except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")