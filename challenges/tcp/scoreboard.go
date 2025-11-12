package main

import (
	"bytes"
	"log"
	"net/http"
	"net/url"
)

type ScoreboardRepo struct {
	Url    string
	APIKey string
}

func (s *ScoreboardRepo) GiveBadge(userid string) error {
	formData := url.Values{
		"userid":    {userid},
		"challenge": {"TCP Beacon"},
	}
	req, err := http.NewRequest("POST", s.Url+"/hook.php", bytes.NewReader([]byte(formData.Encode())))
	if err != nil {
		return err
	}
	req.Header.Set("X-API-KEY", s.APIKey)
	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")
	// send

	log.Default().Printf("Request to Scoreboard: %v\n", req)

	_, err = http.DefaultClient.Do(req)
	if err != nil {
		return err
	}
	return nil
}
