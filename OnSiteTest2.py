
def backwardStr(strInp):
    newStr = strInp
    
    while(1):
        countPa = 0
        for c in newStr:
            if c == "(" :
                countPa += 1
        if countPa == 0:
            return newStr
            break
        pointStart = 0  
        pointEnd = 0
        endPa = 0
        startPa = 0
    
        for a in newStr:
            if a == "(" :
                startPa = pointStart
            pointStart += 1
        
        for b in newStr[startPa+1:]:
            if b == ")" :
                endPa = pointEnd+startPa+1
                break
            pointEnd += 1 
        
        strBackward = newStr[startPa+1:endPa]
        strBackward = strBackward[::-1]
        newStrGET = ""
        newStrGET = newStr[0:startPa]+strBackward+newStr[endPa+1:]
        newStr = newStrGET
       
print('result is :'+backwardStr("(oo(uoo)oip(oo(ip)ip)iopi)"))