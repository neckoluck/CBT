#!/usr/bin/env python3
import csv,sys
path, users=sys.argv[1],int(sys.argv[2])
with open(path,newline='',encoding='utf-8') as f:
    rows=list(csv.DictReader(f))
expected=users*5
assert len(rows)==expected, f'Expected {expected} samples, got {len(rows)}'
expected_codes=['200','303','200','200','200']
from collections import defaultdict
by_thread=defaultdict(list)
for r in rows:
    by_thread[r['threadName']].append(r)
assert len(by_thread)==users, f'Expected {users} distinct threads, got {len(by_thread)}'
for thread, rs in by_thread.items():
    codes=[r['responseCode'] for r in rs]
    assert codes==expected_codes, f'{thread}: Unexpected HTTP codes {codes}'
    assert all(r['success'].lower()=='true' for r in rs),f'{thread}: JMeter reported failure'
    assert rs[2]['label'].startswith('03 GET') and rs[3]['label'].startswith('04 POST'),f'{thread}: Unexpected sample order'
print(f'PASS: {len(rows)} real HTTP samples across {users} distinct JMeter threads; zero HTTP/assertion failures')
