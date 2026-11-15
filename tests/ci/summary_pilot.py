#!/usr/bin/env python3
import csv,sys,math,statistics
path,users,persisted=sys.argv[1],int(sys.argv[2]),int(sys.argv[3])
with open(path,newline='',encoding='utf-8') as f: rows=list(csv.DictReader(f))
ms=sorted(int(r['elapsed']) for r in rows)
p95=ms[math.ceil(0.95*len(ms))-1]
start=min(int(r['timeStamp']) for r in rows)
end=max(int(r['timeStamp'])+int(r['elapsed']) for r in rows)
rate=len(rows)*1000/(end-start) if end>start else 0
errors=sum(r['success'].lower()!='true' for r in rows)
print(f'{users},{len(rows)},{errors},{statistics.mean(ms):.2f},{p95},{rate:.3f},{persisted}')
