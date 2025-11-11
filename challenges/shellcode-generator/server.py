import base64
import secrets

import pwnlib.shellcraft as sc
import redis
from flask import Flask, request
from pwnlib.asm import asm
from pwnlib.util.packing import u32


def calc_xor(a: bytes, b: bytes) -> bytes:
    return bytes(x ^ y for x, y in zip(a, b))


def pkcs_pad(data: bytes, block_size: int) -> bytes:
    pad_len = block_size - (len(data) % block_size)
    return data + bytes([pad_len] * pad_len)


def generate_shellcode(userid: bytes, key: bytes) -> bytes:
    if len(userid) < 16:
        userid = pkcs_pad(userid, 16)

    # split userid into two 4 byte chunks
    u1 = u32(userid[:4], endian="little")
    u2 = u32(userid[4:8], endian="little")
    u3 = u32(userid[8:12], endian="little")
    u4 = u32(userid[12:16], endian="little")
    k1 = u32(key[:4], endian="little")
    k2 = u32(key[4:8], endian="little")
    k3 = u32(key[8:12], endian="little")
    k4 = u32(key[12:16], endian="little")

    shellcode = """
    mov eax, {u4}
    mov ebx, {k4}
    xor eax, ebx
    push eax
    mov eax, {u3}
    mov ebx, {k3}
    xor eax, ebx
    push eax
    mov eax, {u2}
    mov ebx, {k2}
    xor eax, ebx
    push eax
    mov eax, {u1}
    mov ebx, {k1}
    xor eax, ebx
    push eax
    """.format(
        u1=u1,
        u2=u2,
        k1=k1,
        k2=k2,
        u3=u3,
        k3=k3,
        u4=u4,
        k4=k4,
    )
    shellcode += sc.i386.linux.write(1, "esp", 16)
    shellcode += "add esp, 16\n"  # clean up the stack
    shellcode += sc.i386.ret()

    asm_code = asm(shellcode, arch="i386", os="linux")
    return asm_code


def save_to_redis(game: str, userid: str, answer: str):
    r = redis.Redis(host="redis", port=6379, db=0)
    key = f"shellcode:{game}:{userid}"
    r.set(key, answer, ex=3600)  # expire in 1 hour
    r.close()


def create_app():
    app = Flask(__name__)
    app.logger.setLevel("INFO")
    app.logger.info("Shellcode generator server starting...")

    @app.route("/generate", methods=["POST"])
    def generate():
        challenge = request.form.get("challenge")
        userid = request.form.get("userid")
        if not userid or not challenge:
            return "missing userid or challenge", 400

        uid = userid.encode()[:16]  # limit to 16 bytes
        key = secrets.token_bytes(16)

        if len(userid) < 16:
            userid = pkcs_pad(userid, 16)

        answer = calc_xor(uid, key).hex()

        save_to_redis(challenge, userid, answer)
        app.logger.info(
            f"user {userid} for challenge {challenge} saved answer {answer}"
        )

        shellcode = generate_shellcode(uid, key)
        return base64.b64encode(shellcode)

    return app
