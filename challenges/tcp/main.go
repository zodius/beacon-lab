package main

import (
	"log"
	"net"
	"os"
)

func main() {
	shellcodeRepo := &ShellcodeRepo{
		Url: "http://shellcode:5000",
	}
	redisRepo := &RedisRepo{}
	err := redisRepo.Connect("redis:6379")
	if err != nil {
		log.Default().Println("Error connecting to Redis:", err)
		return
	}
	scoreboardRepo := &ScoreboardRepo{
		Url:    "http://scoreboard:80",
		APIKey: os.Getenv("API_KEY"),
	}

	// start tcp socket server
	listener, err := net.Listen("tcp", ":8082")
	if err != nil {
		panic(err)
	}
	defer listener.Close()

	for {
		conn, err := listener.Accept()
		if err != nil {
			continue
		}
		go handleConnection(conn, shellcodeRepo, redisRepo, scoreboardRepo)
	}
}

func handleConnection(conn net.Conn, shellcodeRepo *ShellcodeRepo, redisRepo *RedisRepo, scoreboardRepo *ScoreboardRepo) {
	defer conn.Close()

	log.Default().Println("New connection from", conn.RemoteAddr())

	packet, err := ParsePacket(conn)
	if err != nil {
		log.Default().Println("Error parsing packet:", err)
		return
	}

	log.Default().Printf("Received packet: Action=%d, Payload=%x\n", packet.Action, packet.Payload)

	resPacket := &CommandPacket{}

	switch packet.Action {
	case ActionCall:
		log.Default().Println("Received ActionCall")
		shellcode := shellcodeRepo.GenerateShellcode(packet.KeyString())
		if shellcode == nil {
			return
		}
		resPacket.Action = ActionCallAck
		resPacket.Key = packet.Key
		resPacket.Payload = shellcode
	case ActionResult:
		log.Default().Println("Received ActionResult")
		userid := packet.KeyString()
		submitedAnswer := packet.Payload

		answer, err := redisRepo.GetAnswer(userid)
		if err != nil {
			log.Default().Println("Error getting answer from Redis:", err)
			return
		}

		resPacket.Action = ActionResultAck
		resPacket.Key = packet.Key
		if string(submitedAnswer) == string(answer) {
			log.Default().Println("User", userid, "submitted correct answer")
			resPacket.Payload = []byte("Correct answer")
			scoreboardRepo.GiveBadge(userid)
		} else {
			resPacket.Payload = []byte("Incorrect answer")
		}
	default:
		log.Default().Println("Unknown action")
		return
	}

	encoded := resPacket.Encode()
	conn.Write(encoded)
}
