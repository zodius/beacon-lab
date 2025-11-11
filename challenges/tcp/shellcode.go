package main

import (
	"io"
	"log"
	"net/http"
	"net/url"
)

type ShellcodeRepo struct {
	Url string
}

func (s *ShellcodeRepo) GenerateShellcode(userid [16]byte) []byte {
	challenge := "tcp"

	req, err := http.PostForm(s.Url+"/generate", url.Values{
		"userid":    {string(userid[:])},
		"challenge": {challenge},
	})
	if err != nil {
		log.Default().Println("Error generating shellcode:", err)
		return nil
	}
	defer req.Body.Close()

	shellcode, err := io.ReadAll(req.Body)
	if err != nil {
		return nil
	}
	return shellcode
}
