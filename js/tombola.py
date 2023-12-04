## 12,13,14,15,16,17,18,19,10
## 23,24,25,26,27,28,29,20
## 34,35,36,37,38,39,30
## 45,46,47,48,49,40
## 56,57,58,59,50
## 67,68,69,60
## 78,79,70
## 89,80
## 90

nEquipos = 10

equiposA=[]
equiposB=[]

i=0
n=nEquipos-1
while i<n:
    equiposA.append(i)
    equiposB.append(n)
    i+=1
    n-=1
print(equiposA)
print(equiposB)

n=0
i=0
j=0
equipoAux = []
while n<(nEquipos-1):

    print("Jornada ",n+1)
    while i<(nEquipos/2):
        print(equiposA[i],equiposB[j])
        j+=1
        i+=1
    i=(nEquipos//2)-1
    equipoAux = equiposB[0]
    del equiposB[0]
    aux = equiposA[i]
    equiposB.append(aux)
    del equiposA[i]
    equiposA.insert(1,equipoAux)
    j=0
    i=0
    n+=1
