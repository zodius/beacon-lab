package main

import (
	"net/http"
	"net/url"
	"strings"
)

type ScoreboardRepo struct {
	Url    string
	APIKey string
}

func (s *ScoreboardRepo) GiveBadge(userid [16]byte) error {
	formData := url.Values{
		"userid":    {string(userid[:])},
		"challenge": {"TCP Beacon"},
	}
	req, err := http.NewRequest("POST", s.Url+"/hook.php", strings.NewReader(formData.Encode()))
	if err != nil {
		return err
	}
	req.Header.Set("X-API-KEY", s.APIKey)
	// send
	_, err = http.DefaultClient.Do(req)
	if err != nil {
		return err
	}
	return nil
}
