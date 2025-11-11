package main

import (
	"bytes"
	"encoding/binary"
	"fmt"
	"io"
)

type Action byte

const (
	ActionCall      Action = 0x01
	ActionCallAck   Action = 0x02
	ActionResult    Action = 0x03
	ActionResultAck Action = 0x04
)

type CommandPacket struct {
	Length  uint32
	Key     [16]byte
	Action  Action
	Payload []byte
}

// ParsePacket 從 reader 解析一個封包
func ParsePacket(r io.Reader) (*CommandPacket, error) {
	var p CommandPacket
	header := make([]byte, 4+16+1)
	if _, err := io.ReadFull(r, header); err != nil {
		return nil, err
	}
	p.Length = binary.BigEndian.Uint32(header[:4])
	copy(p.Key[:], header[4:20])
	p.Action = Action(header[20])

	payloadLen := int(p.Length) - (4 + 16 + 1)
	if payloadLen < 0 {
		return nil, fmt.Errorf("invalid length")
	}
	if payloadLen > 0 {
		p.Payload = make([]byte, payloadLen)
		if _, err := io.ReadFull(r, p.Payload); err != nil {
			return nil, err
		}
	}
	return &p, nil
}

// Encode 封包成 bytes
func (p *CommandPacket) Encode() []byte {
	buf := new(bytes.Buffer)
	p.Length = uint32(4 + 16 + 1 + len(p.Payload))
	binary.Write(buf, binary.BigEndian, p.Length)
	buf.Write(p.Key[:])
	buf.WriteByte(byte(p.Action))
	buf.Write(p.Payload)
	return buf.Bytes()
}
